<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
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
        return view('dashboard.notifications.index', ["notifications" => auth()->user()->notifications()->get()]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        $notification->update(["status" => 0]);
        return view('dashboard.notifications.notification', compact("notification"));
    }

    public function showNotifications()
    {
        $notifications = auth()->user()->notifications()->select(["id", "subject", "status", "created_at"]);

        return DataTables::of($notifications->latest())
            ->editColumn('id', env('NOTI_TEMP_PREFIX') . '{{$id}}')
            ->editColumn('subject', function ($notification) {
                $subject = $notification->status == 1 ? '<b>' . $notification->subject . '</b>' : $notification->subject;
                return '<a href="/notifications/' . $notification->id . '">' . $subject . '</a>';
            })
            ->addColumn('created_at', function ($notification) {
                return $notification->created_at->toFormattedDateString();
            })
            ->rawColumns(['subject'])
            ->make(true);
    }

}
