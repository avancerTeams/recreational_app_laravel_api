<?php

namespace App\Http\Controllers;

use App\Http\Resources\Recreation\RecreationCollection;
use App\Http\Resources\Recreation\RecreationResource;
use App\Recreation;
use Illuminate\Http\Request;

class RecreationController extends Controller
{
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Recreation $recreation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recreation  $recreation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recreation $recreation)
    {
        //
    }
}
