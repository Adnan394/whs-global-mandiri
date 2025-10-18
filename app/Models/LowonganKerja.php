<?php

namespace App\Models;
use App\Models\Rank;

use Illuminate\Database\Eloquent\Model;
use App\Models\EmploymentType;
use App\Models\ExperienceLevel;
use App\Models\UserLamaran;
class LowonganKerja extends Model
{
    protected $guarded = ['id'];

    public function rank() {
        return $this->belongsTo(Rank::class);
    }

    public function employment_type() {
        return $this->belongsTo(EmploymentType::class);
    }
    public function experience_level() {
        return $this->belongsTo(ExperienceLevel::class);
    }

    public function lamaran() {
        return $this->belongsTo(UserLamaran::class);
    }
}