<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    public function spe_survey(){
        return $this->belongsToMany(SpeSurvey::class);
    }
}
