<?php

namespace App;

class Penalty extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
