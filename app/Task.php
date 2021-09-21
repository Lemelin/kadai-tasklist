<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['content','status'];
    
    public function modelUser()
    {
        return $this->belongsTo(User::class);
    }
}
