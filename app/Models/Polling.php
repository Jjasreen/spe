<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polling extends Model
{
    use HasFactory;

    public function unit_coordinator()
    {
        return $this->belongsTo(UnitCoordinator::class);
    }

    public function polling_questions()
    {
        return $this->hasMany(PollingQuestion::class);
    }

    public function polling_answers() {
        return $this->hasMany(PollingAnswer::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
