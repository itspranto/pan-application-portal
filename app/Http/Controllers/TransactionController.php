<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaction;
use App\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.transaction.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.transaction.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransaction $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaction $request)
    {
        $transaction = auth()->user()->addTransaction(
            new Transaction($request->only(["type", "amount", "tran_number", "bank", "remarks"]))
        );

        session()->flash("message", "Transaction created successfully! Transaction ID: " . env("TRAN_TEMP_PREFIX") . $transaction->id);

        return redirect("/transactions");
    }

    public function showTransactions()
    {
        $transactions = auth()->user()->transactions()->select(["id", "type", "amount", "status", "created_at"]);

        return DataTables::of($transactions->latest())
            ->editColumn('id', env("TRAN_TEMP_PREFIX") . '{{$id}}')
            ->editColumn('amount', 'Rs. {{$amount}}')
            ->editColumn('type', function ($transaction) {
                return $transaction->type == 1 ? 'PayTM' : 'Bank';
            })
            ->editColumn('status', function ($transaction) {
                switch ($transaction->status) {
                    case 1:
                        $status = ["success", "Completed"];
                        break;
                    case 2:
                        $status = ["info", "Pending"];
                        break;
                    default:
                        $status = ["danger", "Rejected"];
                        break;
                }

                return '<div class="label label-' . $status[0] . '">' . $status[1] . '</div>';
            })
            ->editColumn('created_at', function ($transaction) {
                return $transaction->created_at->toFormattedDateString();
            })
            ->rawColumns(['status'])
            ->make(true);
    }
}
