<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisputeCase extends Model
{
    use HasFactory;
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }
}
