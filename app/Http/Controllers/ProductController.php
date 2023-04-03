<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRating;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\LengthAwarePaginator;
class ProductController extends Controller
{
    public function storeReview(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $review = new ProductReview;
        $review->user_id = auth()->user()->id;
        $review->product_id = $product->id;
        $review->comment = $validatedData['comment'];
        $review->save();
        Alert::success('Review submitted successfully.');
        return redirect()->back();
    }

    public function storeRating(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $rating = new ProductRating;
        $rating->user_id = auth()->user()->id;
        $rating->product_id = $product->id;
        $rating->rating = $validatedData['rating'];
        $rating->save();
        Alert::success('Rating submitted successfully.');
        return redirect()->back();
    }
}
