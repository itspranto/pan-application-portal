<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\UpdateUser;
use App\Pan;
use App\Penalty;
use App\Transaction;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("admin")->except(["showLoginForm", "login"]);
        $this->middleware("admin_guest")->only(["showLoginForm", "login"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view("admin.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            "username" => "required",
            "password" => "required"
        ]);

        try {
            $admin = Admin::where([
                "username" => $request["username"],
                "password" => md5($request["password"])
            ])->firstOrFail();

            session()->regenerate();
            session()->put("admin_id", $admin->id);

            return redirect("/admin/dashboard");
        } catch (ModelNotFoundException $exception) {
            return redirect("/admin/login")->withErrors([
                "message" => "Incorrect Info, try again later!"
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('admin_id');
        return redirect("/admin/login");
    }

    public function getUsers($sorting)
    {
        switch ($sorting) {
            case 'pending':
                $where = ["status" => 2];
                break;
            case 'active':
                $where = ["status" => 1];
                break;
            default:
                $where = [];
                break;
        }

        $users = User::where($where)->select(["id", "vendor_id", "name", "status"]);

        // Well, a bit messy but I need to deliver this quickly!
        return DataTables::of($users->latest())
            ->editColumn('name', function ($user) {
                return '<a href="/admin/users/' . $user->id . '">' . $user->name . '</a>';
            })
            ->addColumn('status', function ($user) {
                switch ($user->status) {
                    case 1:
                        $status = ["success", "Active"];
                        break;
                    case 2:
                        $status = ["info", "Pending"];
                        break;
                    case 0:
                        $status = ["danger", "Blocked"];
                        break;
                    default:
                        $status = ["danger", "Rejected"];
                        break;
                }

                return '<div class="label label-' . $status[0] . '">' . $status[1] . '</div>';
            })
            ->addColumn('new_pan', function ($user) {
                return '<a href="/admin/list/pans/all?type=1&user=' . $user->id . '">' . $user->pans()->whereNull("pan_number")->count()
                    . '</a> | <a href="/admin/list/pans/active?type=1&user=' . $user->id . '">' . $user->pans()
                        ->whereNull("pan_number")
                        ->where(["status" => 1])->count() . '</a>';
            })
            ->addColumn('edit_pan', function ($user) {
                return '<a href="/admin/list/pans/all?type=2&user=' . $user->id . '">' . $user->pans()->whereNotNull("pan_number")->count()
                    . '</a> | <a href="/admin/list/pans/active?type=2&user=' . $user->id . '">' . $user->pans()
                        ->whereNotNull("pan_number")
                        ->where(["status" => 1])->count() . '</a>';
            })
            ->addColumn('accepted', function ($user) {
                return '<a href="/admin/list/pans/active?user=' . $user->id . '">' . $user->pans()->where(["status" => 1])->count() . '</a>';
            })
            ->addColumn('pending', function ($user) {
                return '<a href="/admin/list/pans/pending?user=' . $user->id . '">' . $user->pans()->where(["status" => 2])->count() . '</a>';
            })
            ->addColumn('rejected', function ($user) {
                return '<a href="/admin/list/pans/rejected?user=' . $user->id . '">' . $user->pans()->where(["status" => 0])->count() . '</a>';
            })
            ->addColumn('transactions', function ($user) {
                return '<a href="/admin/list/transactions/all?user=' . $user->id . '">' . $user->transactions()->count() . '</a>';
            })
            ->rawColumns(['name', 'status', 'edit_pan', 'new_pan', 'accepted', 'pending', 'rejected', 'transactions'])
            ->make(true);
    }

    public function getPans($sorting)
    {
        switch ($sorting) {
            case 'pending':
                $where = ["status" => 2];
                break;
            case 'active':
                $where = ["status" => 1];
                break;
            case 'rejected':
                $where = ["status" => 0];
                break;
            default:
                $where = [];
                break;
        }

        if (request()->has("user")) {
            $pans = User::findOrFail(request("user"))->pans()->where($where);
        } else {
            $pans = Pan::where($where);
        }

        $pans->select(["id", "user_id", "pan_number", "status", "first_name", "middle_name", "last_name", "mobile", "documents"]);

        if (request()->has("type")) {
            $pans = (request("type") == 2) ? $pans->whereNotNull("pan_number") : $pans->whereNull("pan_number");
        }

        // Well, a bit messy but I need to deliver this quickly!
        return DataTables::of($pans->latest())
            ->removeColumn("user_id", "pan_number", "first_name", "middle_name", "last_name", "documents")
            ->addColumn('status', function ($user) {
                switch ($user->status) {
                    case 1:
                        $status = ["success", "Accepted"];
                        break;
                    case 2:
                        $status = ["info", "Pending (Upload Needed)"];
                        break;
                    default:
                        $status = ["danger", "Rejected"];
                        break;
                }

                return '<div class="label label-' . $status[0] . '">' . $status[1] . '</div>';
            })
            ->addColumn('name', function ($pan) {
                return $pan->first_name . " " . $pan->middle_name . " " . $pan->last_name;
            })
            ->addColumn('type', function ($pan) {
                return $pan->pan_number == null ? 'New' : 'Correction';
            })
            ->addColumn('view', function ($pan) {
                return '<a href="/admin/pans/' . $pan->id . '"><button class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i> View</button></a>';
            })
            ->addColumn('uploads', function ($pan) {
                if ($pan->documents == null) {
                    $return = '<div class="label label-info">Waiting for Upload</div>';
                } else {
                    $return = '<div class="label label-success">Uploaded</div>';
                }

                return $return;
            })
            ->addColumn('user', function ($pan) {
                $user = $pan->user;
                return '<a href="/admin/users/' . $user->id . '">
                <button class="btn btn-danger btn-xs">' . $user->name . '</button></a>';
            })
            ->rawColumns(['status', 'uploads', 'view', 'user'])
            ->make(true);
    }

    public function getTransactions($sorting)
    {
        switch ($sorting) {
            case 'pending':
                $where = ["status" => 2];
                break;
            case 'active':
                $where = ["status" => 1];
                break;
            case 'rejected':
                $where = ["status" => 0];
                break;
            default:
                $where = [];
                break;
        }

        if (request()->has("user")) {
            $transactions = User::findOrFail(request("user"))->transactions()->where($where);
        } else {
            $transactions = Transaction::where($where);
        }

        $transactions->select(["id", "user_id", "type", "status", "amount", "tran_number"]);

        // Well, a bit messy but I need to deliver this quickly!
        return DataTables::of($transactions->latest())
            ->removeColumn("user_id")
            ->addColumn('status', function ($user) {
                switch ($user->status) {
                    case 1:
                        $status = ["success", "Completed"];
                        break;
                    case 2:
                        $status = ["info", "Pending Authorization"];
                        break;
                    default:
                        $status = ["danger", "Rejected"];
                        break;
                }

                return '<div class="label label-' . $status[0] . '">' . $status[1] . '</div>';
            })
            ->editColumn('type', function ($pan) {
                return $pan->type == 1 ? 'PayTM' : 'Bank';
            })
            ->addColumn('view', function ($transaction) {
                return '<a href="/admin/transactions/' . $transaction->id . '"><button class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i> View & Accept</button></a>';
            })
            ->addColumn('user', function ($transaction) {
                $user = $transaction->user;
                return '<a href="/admin/users/' . $user->id . '">
                <button class="btn btn-danger btn-xs">' . $user->name . '</button></a>';
            })
            ->editColumn('amount', 'Rs. {{$amount}}')
            ->rawColumns(['status', 'view', 'user'])
            ->make(true);
    }

    public function users($sorting)
    {
        return view("admin.users.index", compact("sorting"));
    }

    public function pans($sorting)
    {
        return view("admin.pans.index", compact("sorting"));
    }

    public function transactions($sorting)
    {
        return view("admin.transactions.index", compact("sorting"));
    }

    public function userInfo(User $user)
    {
        return view("admin.users.user", compact("user"));
    }

    public function panInfo(Pan $pan)
    {
        return view("admin.pans.pan", compact("pan"));
    }

    public function transactionInfo(Transaction $transaction)
    {
        return view("admin.transactions.transaction", compact("transaction"));
    }

    public function activateUser(User $user)
    {
        $user->status = 1;
        $user->save();

        $user->notify("Account Activated",
            "Hello {$user->name}, Your account has been activated! Your Vendor ID is: " . $user->vendor_id, true);

        session()->flash("message", "Agent Activated Successfully!");

        return redirect("/admin/users/" . $user->id);
    }

    public function blockUser(User $user)
    {
        $user->status = 0;
        $user->save();

        $user->notify("Account Blocked",
            "Hello {$user->name}, Your account has been blocked!", true);

        session()->flash("message", "Agent Blocked Successfully!");

        return redirect("/admin/users/" . $user->id);
    }

    public function penaltyUser(User $user, Request $request)
    {
        $request->validate([
            "amount" => "bail|required|numeric",
            "reason" => "required"
        ]);

        $user->balance = $user->balance - $request["amount"];

        $user->save();
        $penalty = $user->penalties()->save(new Penalty($request->only(["amount", "reason"])));

        $user->notify("Penalty Received", "Hello {$user->name}, you have received a penalty of <b>Rs. {$penalty->amount}</b> for reason: <span class='text-danger'>{{$penalty->reason}}</span>.");

        session()->flash("message", "Penalty user {$user->name} of Rs. {$penalty->amount} successfull!");

        return redirect("/admin/users/" . $user->id);
    }

    public function updateUser(User $user, UpdateUser $request)
    {
        $user->update($request->only([
            "balance", "name", "mobile", "pin", "address", "city", "state", "shop", "landline", "franchise",
            "business", "pan_number", "adhar_number"
        ]));

        session()->flash("message", "User {$user->name} has updated successfully!");

        return redirect("/admin/users/" . $user->id);
    }

    public function uploadPan(Pan $pan, Request $request)
    {
        $request->validate([
            "receipt" => "bail|required|file|mimes:pdf"
        ]);

        $pan->receipt = Storage::putFile('receipt', $request["receipt"]);
        $pan->status = 1;
        $pan->save();

        $user = $pan->user;
        $user->notify("PAN Application Accepted", "Hello {$user->name}, your PAN Application <b>" . env('PAN_TEMP_PREFIX') . $pan->id . "</b> has been accepted and the receipt has been uploaded.");


        session()->flash("message", "Receipt Successfully Uploaded!");

        return redirect("/admin/pans/" . $pan->id);
    }

    public function rejectPan(Pan $pan, Request $request)
    {
        $request->validate([
            "reject_reason" => "required"
        ]);

        $pan->update([
            "reject_reason" => $request["reject_reason"],
            "status" => 0
        ]);

        $user = $pan->user;
        $user->update([
            "balance" => $user->balance + $pan->fee
        ]);

        $user->notify("PAN Application Rejected", "Hello {$user->name}, your PAN Application <b>" . env('PAN_TEMP_PREFIX') . $pan->id . "</b> has been rejected and corresponding fees has been recredited.");

        session()->flash("message", "Pan has been rejected & Agent {$user->name} has been refunded Rs. {$pan->fee}!");

        return redirect("/admin/pans/" . $pan->id);
    }

    public function validateTransaction(Transaction $transaction)
    {
        $transaction->status = 1;
        $transaction->save();

        $user = $transaction->user;
        $user->update([
            "balance" => $user->balance + $transaction->amount
        ]);

        $user->notify("Transaction Completed", "Hello {$user->name}, your Transaction <b>" . env('TRAN_TEMP_PREFIX') . $transaction->id . "</b> has been accepted and <b>Rs. " . $transaction->amount . "</b> has been credited.");

        session()->flash("message", "Transaction Accepted! Agent {$user->name} has credited with Rs. {$transaction->amount}");

        return redirect("/admin/transactions/" . $transaction->id);
    }

    public function rejectTransaction(Transaction $transaction)
    {
        $transaction->status = 0;
        $transaction->save();

        $user = $transaction->user;
        $user->notify("Transaction Rejected", "Hello {$user->name}, your Transaction <b>" . env('TRAN_TEMP_PREFIX') . $transaction->id . "</b> has been rejected.");

        session()->flash("message", "Transaction rejection successful!");

        return redirect("/admin/transactions/" . $transaction->id);
    }
}
