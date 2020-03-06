<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use App\Http\Resources\Review\ReviewCollection;
use App\Http\Resources\Review\ReviewResource;
use App\Location;
use App\Recreation;
use App\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReviewEndpointsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->headers = [];//['Authorization' => "Bearer $this->token"];
        $this->location = factory(Location::class)->create();
        $this->user = factory(User::class)->create();
        $this->category = factory(Category::class)->create();
        $this->recreation = factory(Recreation::class)->create();
        $this->reviews = factory(Review::class, 2)->create();

        $this->payload = factory(Review::class)->raw();
    } 

    /** @test  */
    public function index__review_are_listed_correctly()
    {
        $response = $this
            ->getJson(route('reviews.index', $this->recreation), [], $this->headers)
            ->assertStatus(200)
            ;
        $response->assertResource(ReviewCollection::collection($this->reviews));
    }

    /** @test */
    public function show__a_review_page_displays_expected_data()
    {
        // dd(route('reviews.show', $this->reviews[0]));
        $response = $this
                ->getJson(route('reviews.show', $this->reviews[0]), [], $this->headers)
                ->assertStatus(200)
                ;

        $response->assertResource(new ReviewResource($this->reviews[0]));
    }

    /** @test */
    public function store__review_can_be_created_successfulyy() 
    {
        $this
            ->postJson(route('reviews.store'), $this->payload, $this->headers)
            ->assertStatus(201)
            ->assertJsonFragment([
                'rating' => $this->payload['rating'],
                'comment'  => $this->payload['comment'],
                'authorId'  => $this->payload['user_id'],
                'recreationId'  => $this->payload['recreation_id'],
            ])
            ;
        $this
            ->assertDatabaseHas('reviews', $this->payload)
            ;
    }

    /** @test */
    public function update__reviews_are_updated_successfully()
    {
        $payload = [
            'rating' => 3,
            'comment'  => 'an amazing comment.',
            'user_id' => $this->user->id,
            'recreation_id' => $this->recreation->id,
        ];

        $this
            ->putJson(route('reviews.update', $this->reviews[0]), $payload, $this->headers)
            ->assertStatus(200)
            ->assertJsonFragment([
                'rating' => 3,
                'comment'  => 'an amazing comment.',
                'authorId' => $this->user->id,
                'recreationId' => $this->recreation->id,
            ])
            ;
        $this
            ->assertDatabaseHas('reviews', $payload)
            ;
    }

    /** @test */
    public function destroy__reviews_are_deleted_successfully()
    {
        $this
            ->deleteJson(route('reviews.destroy', $this->reviews[0]), [], $this->headers)
            ->assertStatus(204)
            ;
        $this
            ->assertDatabaseMissing('reviews', $this->reviews[0]->toArray())
            ;
    }
}
