<?php

namespace App;


class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
