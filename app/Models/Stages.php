<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stages extends Model
{
    use HasFactory, SoftDeletes;

    public function forms()
    {
        return $this->hasMany(Form::class, 'stage_id');
    }
}
