<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LowonganKerja;

class ExperienceLevel extends Model
{
    protected $guarded = ['id'];

    public function lowongan()
    {
        return $this->hasMany(LowonganKerja::class);
    }
}