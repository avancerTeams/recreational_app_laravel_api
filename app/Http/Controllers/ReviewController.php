<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\Review\ReviewCollection;
use App\Http\Resources\Review\ReviewResource;
use App\Recreation;
use App\Review;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Recreation $recreation)
    {
        $reviews = Review::where('recreation_id', $recreation->id)->paginate(5);

        return ReviewCollection::collection($reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, Review $review)
    {
        // Double check by policy if hasCreateAccess
        
        $review = Review::create($request->all());

        $resource = new ReviewResource($review);

        return response()->json($resource, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, Review $review)
    {
        // Double check by policy if hasUpdateAccess
        
        $review->update($request->all());

        $resource = new ReviewResource($review);

        return response()->json($resource, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        // Double check by policy if hasUpdateAccess

        $review->delete();

        return response()->json(null, 204);
    }
}
