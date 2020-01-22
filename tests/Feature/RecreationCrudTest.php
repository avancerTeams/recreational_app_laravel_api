<?php

namespace Tests\Feature;

use App\Category;
use App\Http\Resources\Recreation\RecreationCollection;
use App\Http\Resources\Recreation\RecreationResource;
use App\Location;
use App\Recreation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RecreationCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->headers = [];//['Authorization' => "Bearer $this->token"];
        $this->location = factory(Location::class)->create();
        $this->category = factory(Category::class)->create();
        $this->recreations = factory(Recreation::class, 2)->create();

        $this->payload = factory(Recreation::class)->raw();
    } 

    /** @test  */
    public function index__recreation_are_listed_correctly()
    {
        // route('recreations.index') === "http://localhost/api/v1/recreations"
        $response = $this
            ->getJson(route('recreations.index'), [], $this->headers)
            ->assertStatus(200)
            ;
        /**
         * assertResource is a macro created with Tests\CreatesApplication.php
         * 
         * Test that exact Recreation resource attributes json structure 
         * is rendered when the index URL is accessed.
         * This advanced test for $this->assertJsonFragment($response);
         */
        $response->assertResource(RecreationCollection::collection($this->recreations));
    }

    /** @test */
    public function show__a_recreation_page_displays_expected_data()
    {
        $response = $this
                ->getJson(route('recreations.show', $this->recreations[0]), [], $this->headers)
                ->assertStatus(200)
                ;

        $response->assertResource(new RecreationResource($this->recreations[0]));
    }

    /** @test */
    public function store__recreation_can_be_created_successfulyy() 
    {
        // $this->admin = factory(User::class)->state('admin')->create();

        $this
            ->postJson(route('recreations.store'), $this->payload, $this->headers)
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => $this->payload['name'],
                'address'  => $this->payload['address'],
                'locationId'  => $this->payload['location_id'],
                'categoryId'  => $this->payload['category_id'],
            ])
            ;
        $this
            ->assertDatabaseHas('recreations', $this->payload)
            ;
    }

    /** @test */
    public function update__recreations_are_updated_successfully_by_an_admin()
    {
        // $admin = factory(User::class)->state('admin')->create();

        $payload = [
            'name' => 'Agodi Gardens',
            'address'  => 'GRA Secretariat road.',
            'active'  => 0,
            'location_id' => $this->location->id,
            'category_id' => $this->category->id,
        ];

        $this
            ->putJson(route('recreations.update', $this->recreations[0]), $payload, $this->headers)
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Agodi Gardens',
                'address'  => 'GRA Secretariat road.',
                'locationId' => $this->location->id,
                'categoryId' => $this->category->id,
            ])
            ;
        $this
            ->assertDatabaseHas('recreations', $payload)
            ;
    }

    /** @test */
    public function destroy__recreations_are_deleted_successfully_by_an_admin()
    {
        // $admin = factory(User::class)->state('admin')->create();

        $this
            ->deleteJson(route('recreations.destroy', $this->recreations[0]), [], $this->headers)
            ->assertStatus(204)
            ;
        $this
            ->assertDatabaseMissing('recreations', $this->recreations[0]->toArray())
            ;
    }

}
