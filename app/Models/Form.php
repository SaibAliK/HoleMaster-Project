<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_name',
        'category',
        'seen_by',
        'is_locked',
        'stage_id',
    ];

    public function jobDetail(){
        return $this->belongsTo(JobDetail::class);
    }
    public function jobDetailForm(){
        return $this->hasMany(jobDetailForm::class);
    }

    public function sections(){
        return $this->hasMany(Section::class)->with('questions:id,precaution,question,type,is_required,section_id');
    }
    public function stage(){
        return $this->belongsTo(Stages::class)->withTrashed();
    }

   
}
