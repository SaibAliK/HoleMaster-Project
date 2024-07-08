<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operative extends Model
{
    use HasFactory;
    use SoftDeletes;

protected $fillable = ['parent_id'];

    public function users(){
        return $this->belongsTo(User::class,'parent_id')->withTrashed();
    }

    public function operativeUsers(){
        return $this->belongsTo(User::class,'user_id');
    }
}