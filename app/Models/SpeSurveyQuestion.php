<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeSurveyQuestion extends Model
{
   use HasFactory;
   
   public function module() 
   {
    return $this->belongsTo(Module::class);
   }

   public function spe_survey() 
   {
    return $this->belongsTo(SpeSurvey::class);
   }
}
