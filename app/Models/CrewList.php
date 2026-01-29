<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrewList extends Model
{
    protected $guarded = ['id'];

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    public function crew()
    {
        return $this->belongsTo(crew::class);
    }
}