<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    // 店舗一覧表示
    public function index(Request $request)
    {
        $all_area = 'All area';
        $all_genre = 'All genre';
        $areas = array($all_area);
        $genres = array($all_genre);
        $shops = Shop::query();
        foreach ($shops as $shop) {
            $areas[] = $shop['area'];
            $genres[] = $shop['genre'];
        }
        $areas = array_unique($areas);
        $genres = array_unique($genres);
        $areas = Area::all();
        $genres = Genre::all();
        $s = $request->input('s');
        $a = $request->input('a');
        $g = $request->input('g');

        if ($s !== null) {
            $shops->where('shops.name', 'LIKE', '%' . $s . '%');
        }
        if ($a !== null) {
            $shops->where('area_id', '=', $a);
        }
        if ($g !== null) {
            $shops->where('genre_id', '=', $g);
        }
        $shops = $shops->get();

        return view('index', compact('shops', 'genres', 'areas', 'g', 'a', 's'));
    }

    // 店舗詳細表示
    public function detail(Request $request, $shop_id)
    {
        $shop = Shop::find($shop_id);
        $tomorrow = now()->addDay()->format('Y-m-d');
        if ($request->has('date')) {
            $reserve_date = $request->date;
        } else {
            $reserve_date = session()->has('date') ? session('date') : $tomorrow;
        }
        session(['date' => $reserve_date]);

        $time_array = [];
        $num_array = [];
        $my_review = null;
        $reviews = Review::where('shop_id', $shop_id)->get();
        if( Auth::check() ){
            $tmp_review = Review::select()->UserSearch(Auth::id())->ShopSearch($shop_id)->get();
            $my_review = $tmp_review->isEmpty() ? null : $tmp_review->toArray()[0];
        }
        return view('shop_detail', compact('shop', 'tomorrow', 'reserve_date', 'time_array', 'num_array','my_review', 'reviews'));
    }
}
