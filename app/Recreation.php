<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recreation extends Model
{
    protected $fillable = [
        'name',
        'address',
        'location_id',
        'category_id',
        'active',
        'opening_hour',
        'closing_hour',
    ];

    public function location() 
    {
    	return $this->belongsTo(Location::class);
    }

    public function category() 
    {
    	return $this->belongsTo(Category::class);
    }

    public function reviews() 
    {
    	return $this->hasMany(Review::class);
    }

    public function isActive() 
    {
        return (bool) $this->active;
    }

    // ------- Remove the below until Image model is set

    public function images() 
    {
    	return $this->hasMany(Image::class);
    }

    public function profileImage() {
    	return $this->images()
    		->where('imageable_type', 'App\Recreation')
    		->where('role', '1')
    		->url
    		;
    }
    public function coverImage() {
    	return $this->images()
    		->where('imageable_type', 'App\Recreation')
    		->where('role', '2')
    		->url
    		;
    }
}
