<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function teams(){
        return $this->belongsToMany(Team::class)->withPivot('role_type');
    }

    public function survey(){
        return $this->belongsToMany(SpeSurvey::class);
    }

    
}

