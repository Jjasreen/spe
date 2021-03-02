<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function students(){
        return $this->belongsToMany(Student::class);
    }
}
