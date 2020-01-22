<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function recreations() 
    {
    	return $this->hasMany(Recreation::class);
    }

    public function users() 
    {
    	return $this->hasMany(User::class);
    }
}
