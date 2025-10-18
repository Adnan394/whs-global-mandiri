<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserPertanyaan;
class Pertanyaan extends Model
{
    //
    protected $guarded = ['id'];

    public function user_pertanyaan() {
        return $this->belongsTo(UserPertanyaan::class);
    }
}