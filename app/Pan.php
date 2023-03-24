<?php

namespace App;


class Pan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
