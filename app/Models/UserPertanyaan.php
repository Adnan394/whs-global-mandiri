<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pertanyaan;

class UserPertanyaan extends Model
{
    //
    protected $guarded=['id'];

    public function pertanyaan() {
        return $this->hasMany(Pertanyaan::class);
    }
}