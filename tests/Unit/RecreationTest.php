<?php

namespace Tests\Unit;

use App\Category;
use App\Location;
use App\Recreation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RecreationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->location = factory(Location::class)->create();
        $this->category = factory(Category::class)->create();
        $this->recreation = factory(Recreation::class)->create();
    } 

    /** @test  */
    public function recreations_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('recreations', [
            'id',
	        'name',
	        'address',
	        'location_id',
	        'category_id',
	        'active',
	        'opening_hour',
	        'closing_hour',
        ]), 1);
    }

    /** @test */
    public function a_recreation_belongs_to_a_location()
    {
        // Method 1: Test by count that a recreation has a parent relationship with location
        $this->assertEquals(1, $this->recreation->location->count());

        // Method 2: 
        $this->assertInstanceOf(Location::class, $this->recreation->location);
    }

    /** @test */
    public function a_recreation_belongs_to_a_category()
    {
        $this->assertInstanceOf(Category::class, $this->recreation->category);
    }
}
