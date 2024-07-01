<?php

namespace App\Http\Controllers;

use DateTime;
use Arr;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Review;
use App\Models\Favorite;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\AddShopRequest;
use App\Http\Traits\Content;
use App\Consts\SortOptConst;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    // use Content;
    /*
        店の一覧表示
    */
    public function index(Request $request)
    {
        $all_area = 'All area';     // 全地域のフィルタに表示する文字列
        $all_genre = 'All genre';     // 全ジャンルのフィルタに表示する文字列

        /* ドロップダウンリストに表示する文字列の生成 */
        $shops = Shop::query();

        $areas = array($all_area); // $areas = ['All area']この段階ではAll areaしか」入ってない
        $genres = array($all_genre);
        foreach ($shops as $shop) {
            $areas[] = $shop['area']; // $areas = ['All area', area1, area2, area3, ...]ここで足して行っている
            $genres[] = $shop['genre'];
        }
        $areas = array_unique($areas);
        $genres = array_unique($genres);



        // ログインユーザー情報取得
        // $user = Auth::user();
        // areasテーブル情報取得
        $areas = Area::all();
        $genres = Genre::all();
        //検索値の取得
        $s = $request->input('s');
        $a = $request->input('a');
        $g = $request->input('g');



        //クエリの取得
        // $query = DB::table('shops');
        //リレーション
        // $query->leftJoin('users', 'reviews.user_id', '=', 'users.id');
        // $query->leftJoin('areas', 'shops.area_id', '=', 'areas.id');
        // $query->leftJoin('genres', 'shops.genre_id', '=', 'genres.id');
        // $query->select('shops.*', 'areas.name as area_name', 'genres.name as genre_name');
        // $query->orderBy('created_at', 'desc');

        if ($s !== null) {
            $shops->where('shops.name', 'LIKE', '%' . $s . '%');
            // //全角を半角に
            // $search_split = mb_convert_kana($s, 's');
            // //半角で文字を切り分けて、配列に入れる
            // $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);
            // dump($search_split2);
            // //配列をforeachでまわして、where条件を付け加える
            // foreach ($search_split2 as $value) {
            //     $shops->where('shops.name', 'LIKE', '%' . $value . '%');
            // }
        }

        if ($a !== null) {
            $shops->where('area_id', '=', $a);
            // $query->where('area_id', '=', $a);
        }
        if ($g !== null) {
            $shops->where('genre_id', '=', $g);
            // $query->where('genre_id', '=', $g);
        }

        $shops = $shops->get();

        return view('index', compact('shops', 'genres', 'areas', 'g', 'a', 's'));
    }

    /*
        店の詳細表示
    */
    public function detail(Request $request, $shop_id)
    {
        $shop = Shop::find($shop_id);
        // $shop['image_url'] = Storage::url($shop['image_url']);

        $tomorrow = now()->addDay()->format('Y-m-d');
        if ($request->has('date')) {
            $reserve_date = $request->date;
        } else {
            $reserve_date = session()->has('date') ? session('date') : $tomorrow;
            //  session()->has('date'):trueならこちらのデータを保存する。$tomorrow;：falseならこちらのデータを $reserve_dateに代入する
        }
        session(['date' => $reserve_date]);
        // sessionに渡している
        $time_array = [];
        $num_array = [];

        // [$time_explanation, $time_array] = $this->getTimeArray($reserve_date, $shop->operation_pattern, $shop->time_per_reservation);
        // $num_array = $this->getNumArray($shop['id']);

        $my_review = null;
        if( Auth::check() ){
            $tmp_review = Review::select()->UserSearch(Auth::id())->ShopSearch($shop_id)->get();
            $my_review = $tmp_review->isEmpty() ? null : $tmp_review->toArray()[0];
            // if ( !is_null($my_review) ) {
            //     $my_review['image_url'] = empty($my_review['image_url']) ? null : Storage::url($my_review['image_url']);
            // }
        }
        return view('shop_detail', compact('shop', 'tomorrow', 'reserve_date', 'time_array', 'num_array', 'my_review'));
    }
}
