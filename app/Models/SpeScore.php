<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeScore extends Model
{

    protected $fillable = ['student_id', 'team_id', 'spe_survey_id',
         'spe_total_scores', 'spe_score_type', 'submit_count', 'all_submitted'];
         
    use HasFactory;

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function team() {
        return $this->belongsTo(Team::class);
    }
    
    public function speSurvey() {
        return $this->belongsTo(SpeSurvey::class);
    }
}
