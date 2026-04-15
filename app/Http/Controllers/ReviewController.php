<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'rating'    => 'required|numeric|min:1|max:5',
            'comment'   => 'nullable|string|max:1000',
        ]);

        // 2. إذا الطالب مقيم قبل هيك بتعدل تقييمه، وإذا لا بتعمل جديد
        $review = Review::updateOrCreate(
            [
                'user_id'   => Auth::id(),
                'course_id' => $request->course_id
            ],
            [
                'rating'    => $request->rating,
                'comment'   => $request->comment
            ]
        );

        return response()->json([
            'icon'  => 'success',
            'title' => 'شكرا لتقييمك!'
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
