<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function creator(){
        return $this->belongsTo(User::class);
    }

    public function bookedBy(){
        return $this->hasMany(User::class);
    }
}
