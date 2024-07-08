<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetailForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_detail_id',
        'form_id','is_locked'
    ];



    public function jobDetail()
    {
        return $this->belongsTo(JobDetail::class, 'job_detail_id', 'id')->with(['userClient', 'userOperative','jobSite']);
    }

    public function forms()
    {
        return $this->belongsTo(Form::class, 'form_id', 'id')->with(['sections:id,section_name,form_id','stage:id,name']);
    }

    public function responses()
    {
        return $this->hasMany(SaveResponse::class,'job_form_id');
    }

}
