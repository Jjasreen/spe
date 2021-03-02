<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    public function unit_coordinator(){
        return $this->belongsTo(UnitCoordinator::class);
    }

    public function team(){
        return $this->belongsToMany(Team::class);
    }

    public function spe_surveys(){
        return $this->belongsTo(SpeSurvey::class);
    }
}
