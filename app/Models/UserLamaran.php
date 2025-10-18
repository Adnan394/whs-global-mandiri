<?php

namespace App\Models;

use App\Models\LowonganKerja;
use Illuminate\Database\Eloquent\Model;

class UserLamaran extends Model
{
    protected $guarded = ['id'];

    public function lowongan() {
        return $this->hasMany(LowonganKerja::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}