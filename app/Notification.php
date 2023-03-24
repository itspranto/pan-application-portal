<?php

namespace App;

class Notification extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
