<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecreationRequest;
use App\Http\Resources\Recreation\RecreationCollection;
use App\Http\Resources\Recreation\RecreationResource;
use App\Recreation;
use App\Location;
use App\Category;
use Illuminate\Http\Request;

class RecreationController extends Controller
{
    public function __construct() 
    {
        // $this->middleware('admin')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recreations = Recreation::orderBy('name')->paginate(5);

        return RecreationCollection::collection($recreations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecreationRequest $request)
    {
        // Double check by policy if hasCreateAccess
        
        $recreation = Recreation::create($request->all());

        $resource = new RecreationResource($recreation);

        return response()->json($resource, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recreation  $recreation
     * @return \Illuminate\Http\Response
     */
    public function show(Recreation $recreation)
    {
        return new RecreationResource($recreation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recreation  $recreation
     * @return \Illuminate\Http\Response
     */
    public function update(RecreationRequest $request, Recreation $recreation)
    {
        // Double check by policy if hasUpdateAccess
        
        $recreation->update($request->all());

        $resource = new RecreationResource($recreation);

        return response()->json($resource, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recreation  $recreation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recreation $recreation)
    {
        // Double check by policy if hasUpdateAccess

        $recreation->delete();

        return response()->json(null, 204);//Response::HTTP_NO_CONTENT
    }

    public function by_location(Location $location)
    {
        // Listing recreations by location

        $recreations = Recreation::where('location_id', $location->id)->paginate(5);

        return RecreationCollection::collection($recreations);
    }

    public function by_category(Category $category)
    {
        // Listing recreations by category

        $recreations = Recreation::where('category_id', $category->id)->paginate(5);

        return RecreationCollection::collection($recreations);
    }
}
