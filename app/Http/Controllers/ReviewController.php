<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function store(Request $request)
    {
        // \Log::info('Session Data Before:', session()->all());

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'username' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->username = $request->username;
        $review->rating = $request->rating;
        $review->comment = $request->review;
        $review->save();

        // \Log::info('Session Data After:', session()->all());

        return redirect()->back()->with('success', 'Отзивът беше добавен успешно!');

    }
}
