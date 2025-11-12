<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class crew extends Model
{
    //
    protected $guarded=['id'];

    public function rank()
    {
        return $this->belongsTo(rank::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}