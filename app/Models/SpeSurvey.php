<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeSurvey extends Model
{
    use HasFactory;

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function spe_survey_questions(){
        return $this->hasMany(SpeSurveyQuestion::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

 
}
