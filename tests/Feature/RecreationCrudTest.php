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

        $this->location = factory(Location::class)->create();
        $this->category = factory(Category::class)->create();
        $this->recreations = factory(Recreation::class, 2)->create();

        $this->payload = factory(Recreation::class)->raw();
    } 

    /** @test  */
    public function index__recreation_are_listed_correctly()
    {
        //
    }

    public
}
