<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingQuestion extends Model
{
    use HasFactory;

    public function module() 
    {
     return $this->belongsTo(Module::class);
    }

    public function polling()
    {
        return $this->belongsTo(Polling::class);
    }
}
