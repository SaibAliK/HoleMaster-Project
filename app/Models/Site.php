<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'site',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function job()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
