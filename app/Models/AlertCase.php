<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertCase extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function spe_survey() {
        return $this->belongsTo(SpeSurvey::class);
    }

    public function peer() {
        return $this->belongsTo(Student::class, 'peer_id');
    }

    public function team() {
        return $this->belongsTo(Team::class);
    }
}
