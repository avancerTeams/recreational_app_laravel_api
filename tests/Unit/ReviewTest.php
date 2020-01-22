<?php

namespace Tests\Unit;

use App\Category;
use App\Location;
use App\Recreation;
use App\Review;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->location = factory(Location::class)->create();
        $this->user = factory(User::class)->create();
        $this->category = factory(Category::class)->create();
        $this->recreation = factory(Recreation::class)->create();
        $this->review = factory(Review::class)->create(['rating'=>1]);
    } 

    /** @test  */
    public function reviews_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('reviews', [
            'id',
	        'user_id',
	        'recreation_id',
	        'rating',
	        'comment',
        ]), 1);
    }

    /** @test */
    public function a_review_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->review->user);
    }

    /** @test */
    public function a_review_belongs_to_a_recreation()
    {
        $this->assertInstanceOf(Recreation::class, $this->review->recreation);
    }

    /** @test */
    public function a_review_has_rating_attribute()
    {
        $this->assertNotEmpty($this->review->rating);
    }

    /** @test */
    public function a_review_rating_is_an_integer_between_1_and_5()
    {
    	$rRating = $this->review->rating;
    	$isIntBetween1n5 = (is_int($rRating) && ($rRating >=1 && $rRating <=5));

        $this->assertTrue($isIntBetween1n5);
    }

    /** @test */
    public function a_review_has_comment_attribute()
    {
        $this->assertNotEmpty($this->review->comment);
    }
}
