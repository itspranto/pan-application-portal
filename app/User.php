<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pans()
    {
        return $this->hasMany(Pan::class);
    }

    public function addPan(Pan $pan)
    {
        return $this->pans()->save($pan);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function addTransaction(Transaction $transaction)
    {
        $transaction->status = 2;
        return $this->transactions()->save($transaction);
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notify2($subject, $message, $only_mail = false)
    {
        $only_mail ?: $this->notifications()->create(["subject" => $subject, "message" => $message, "status" => 1]);
        Mail::raw(strip_tags($message), function ($message) use (&$subject) {
            $message->to($this->email)
            ->subject($subject);
        });
    }
}
