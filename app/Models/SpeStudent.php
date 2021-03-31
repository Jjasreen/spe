<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeStudent extends Model
{
    
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function speSurvey()
    {
        return $this->belongsTo(SpeSurvey::class);
    }
}
