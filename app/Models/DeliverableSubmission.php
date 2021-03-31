<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverableSubmission extends Model
{
    use HasFactory;
    
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
