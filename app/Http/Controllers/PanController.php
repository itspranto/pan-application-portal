<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePan;
use App\Pan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PanController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("pan_bal_check")->only(["create", "store", "edit", "update"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.pans.index");
    }

    public function showPans()
    {
        $pans = auth()->user()->pans()->select(["id", "first_name", "middle_name", "last_name", "mobile", "status", "pan_number", "documents", "reject_reason"]);

        return DataTables::of($pans->latest())
            ->removeColumn("pan_number", "first_name", "middle_name", "last_name", "documents", "reject_reason")
            ->addColumn('name', function ($pan) {
                return $pan->first_name . " " . $pan->middle_name . " " . $pan->last_name;
            })
            ->editColumn('id', function ($pan) {
                return '<a href="/pans/receipt/' . $pan->id . '">' . env("PAN_TEMP_PREFIX") . $pan->id . '</a>';
            })
            ->editColumn('status', function ($pan) {
                if ($pan->status == 1) {
                    return '<a href="/pans/download/' . $pan->id . '">
                                    <button type="button" class="btn btn-success btn-xs">Download Receipt</button>
                                </a>';
                } elseif ($pan->status == 2) {
                    return '<div class="label label-info">Waiting for Admin Upload</div>';
                } else {
                    return '<div class="label label-danger">Rejected</div>
                                    <div class="text-danger">Reason: ' . $pan->reject_reason . '</div>';
                }
            })
            ->addColumn('type', function ($pan) {
                return $pan->pan_number == null ? 'New' : 'Correction';
            })
            ->addColumn('uploads', function ($pan) {
                if ($pan->documents == null) {
                    $return = '<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#uploadDoc-' . $pan->id . '">Upload Files
                    </button>';
                } else {
                    $return = '<div class="label label-success">Uploaded</div>
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                            data-target="#uploadDoc-' . $pan->id . '">Upload Again
                    </button>';
                }

                $return .= '<div id="uploadDoc-' . $pan->id . '" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                                <h4 class="modal-title">Upload Files</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="/pans/upload/' . $pan->id . '"
                                                      enctype="multipart/form-data">
                                                    ' . csrf_field() . '

                                                    <div class="form-group">
                                                        <label for="documents">Documents File (PDF <1MB)</label>
                                                        <input type="file" class="form-control" name="documents">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="photo">Photo (Default as Scanning and Cropping Utility)</label>
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="signature">Signature (Default as Scanning and Cropping Utility)</label>
                                                        <input type="file" class="form-control" name="signature">
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>';
                return $return;
            })
            ->rawColumns(['status', 'uploads', 'id'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.pans.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePan|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePan $request)
    {
        $pan = auth()->user()->addPan(
            new Pan($this->allowedData())
        );

        $this->chargeUser();

        return view("dashboard.pans.create")->with("pan_id", $pan->id);
    }

    protected function allowedData()
    {
        $data = request([
            "category", "date", (!request()->has("pan_number") ?: "pan_number"),
            "last_name", "first_name", "middle_name", "card_name", "father_last_name",
            "father_first_name", "father_middle_name", "dob", "mobile", "gender", "email", "adhar_number",
            "adhar_proof", "identity_proof", "dob_proof", "address_proof", "c_o", "flat", "premises",
            "road", "area", "area_pin", "state", "city", "pin"
        ]);

        $data["fee"] = env("PROCESSING_FEE");
        $data["date"] = Carbon::parse($data["date"])->toDateString();
        $data["dob"] = Carbon::parse($data["dob"])->toDateString();
        $data["adhar_proof"] = Storage::putFile('images/pans/adhar', $data["adhar_proof"]);
        $data["status"] = 2;

        return $data;
    }

    public function insufficientBalance()
    {
        return view("dashboard.pans.insufficient_balance");
    }

    protected function chargeUser()
    {
        $user = auth()->user();
        $user->balance = $user->balance - env("PROCESSING_FEE");
        $user->save();
    }

    public function receipt(Pan $pan)
    {
        return view("dashboard.pans.receipt")->with(["pan" => $pan, "user" => $pan->user]);
    }

    public function upload(Pan $pan, Request $request)
    {
        $request->validate([
            "documents" => "bail|required|file|mimes:pdf|max:1024",
            "photo" => "bail|required|file|image",
            "signature" => "bail|required|file|image",
        ]);

        $pan->documents = Storage::putFile('documents', $request["documents"]);
        $pan->photo = Storage::putFile('photo', $request["photo"]);
        $pan->signature = Storage::putFile('signature', $request["signature"]);
        $pan->save();

        session()->flash("message", "Documents Successfully Uploaded!");

        return redirect("/pans");
    }

    public function download(Pan $pan)
    {
        $response = response(Storage::get($pan->receipt), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Receipt_' . env("PAN_TEMP_PREFIX") .$pan->id.'.pdf"'
        ]);

        return $response;
    }
}
