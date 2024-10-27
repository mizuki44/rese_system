<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    // レビュー一覧ページ表示
    public function index(Request $request)
    {
        $reviews = Review::get();

        return view('admin.review_list', compact('reviews'));
    }


    // レビュー削除
    public function delete(Request $request)
    {
        $id = $request->review_id;
        $review = Review::where('id', $id)->delete();
        if ($review) {
            return redirect('admin/review');
        }
    }
}
