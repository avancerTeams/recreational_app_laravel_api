<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id','recreation_id','rating','comment',
    ];

    public function user() 
    {
    	return $this->belongsTo(User::class);
    }

    public function recreation() 
    {
    	return $this->belongsTo(Recreation::class);
    }
}
