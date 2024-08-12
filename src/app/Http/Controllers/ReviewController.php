<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthControllers;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use App\Http\Traits\Content;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // レビュー作成ページ表示
    public function create(Request $request, $shop_id)
    {
        if (!Auth::check()) return redirect('login');

        $shop = Shop::find($shop_id);
        $tmp_favorites = Favorite::select()->UserSearch(Auth::id())->ShopSearch($shop_id)->get();
        $shop['favorite'] = !$tmp_favorites->isEmpty();

        return view('review_add', compact('shop'));
    }

    // レビュー投稿
    public function store(ReviewRequest $request)
    {
        if (!Auth::check()) return redirect('login');

        $table = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'star' => $request->star,
            'comment' => $request->comment,
        ];
        $review = Review::create($table);

        return redirect('/detail/' . $request->shop_id);
    }

    // レビュー削除
    public function destroy(Request $request)
    {
        $account_check = false;
        if (Auth::guard('admin')->check()) {
            if ($this->isAdmin(Auth::guard('admin')->user()->role)) $account_check = true;
        } elseif (Auth::check()) {
            if (Auth::user()->id == $request->user_id) $account_check = true;
        }

        if ($account_check) {
            $review = Review::select()->UserSearch($request->user_id)->ShopSearch($request->shop_id);
            $review->delete();
        }

        return redirect()->back();
    }

    // レビュー変更ページ表示
    public function edit(Request $request, $shop_id)
    {
        if (!Auth::check()) return redirect('login');

        $shop = Shop::find($shop_id);
        $tmp_favorites = Favorite::select()->UserSearch(Auth::id())->ShopSearch($shop_id)->get();
        $shop['favorite'] = !$tmp_favorites->isEmpty();
        $review = Review::select()->UserSearch(Auth::id())->ShopSearch($shop_id)->first();
        if (is_null($review)) return redirect()->back();

        return view('review_edit', compact('shop', 'review'));
    }

    // レビュー更新
    public function update(ReviewRequest $request)
    {
        if (!Auth::check()) return redirect('login');

        $table = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'star' => $request->star,
            'comment' => $request->comment,
        ];

        $review = Review::select()->UserSearch($request->user_id)->ShopSearch($request->shop_id);
        switch ($request->img_edit_mode) {
            case 0:
                $tmp_review = $review->first();
                break;
            case 1:
                break;
        }
        $review->update($table);

        return redirect('/detail/' . $request->shop_id);
    }
}
