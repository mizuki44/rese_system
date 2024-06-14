<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Arr;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\AddShopRequest;
use App\Http\Traits\Content;
use App\Consts\SortOptConst;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthControllers;
use Carbon\Carbon;


class MypageController extends Controller
{
    /*
        マイページを表示する
    */
    public function create()
    {
        $user_id = Auth::id();
        $reservations = $this->getRreservedShops($user_id);
        $favorites = Favorite::select()->UserSearch($user_id)->get();

        return view('my_page', compact('reservations', 'favorites'));
    }
    /*
        予約している店舗情報を取得する(プライベート関数)
    */
    private function getRreservedShops($user_id)
    {
        $now = Carbon::now();
        $now_format = $now->format('Y-m-d');
        $reservations = Reservation::select()->UserIdSearch($user_id)->EndsAfterSearch($now_format)->get();
        $reserved_shops = array();
        $reservation_num = 1;
        foreach ($reservations as $reservation) {
            $shop_name = Shop::find($reservation->shop_id)->name;
            $reserve_info = array(
                'reservation_num' => $reservation_num,
                'id' => $reservation->id,
                'shop_name' => $shop_name,
                'date' => $reservation->date,
                'time' => $reservation->time,
                'number' => $reservation->number
            );
            $reserved_shops[] = $reserve_info;
            $reservation_num++;
        }

        return $reserved_shops;
    }

    /*
        お気に入り店舗情報を取得する(プライベート関数)
    */
    private function getFavoriteShops($user_id)
    {
        $favorites = Favorite::select()->UserSearch($user_id)->get();
        // $favorite_shops = array();
        // foreach ($favorites as $favorite) {
        //     $shop_id = $favorite->shop_id;
        //     $favorite_shops[] = Shop::find($shop_id);
        // $shop_info = array(
        //     'id' => $shop->id,
        //     'name' => $shop->name,
        //     'area' => $shop->area,
        //     'genre' => $shop->genre,
        //     'image_url' => Storage::url($shop->image_url),
        //     'favorite' => true
        // );
        // $favorite_shops[] = $shop_info;
    }

    // return $favorite_shops;
}


    /*
        QRコードを表示する
    */
    // public function showQrCode(Request $request)
    // {
    //     $reservation_id = $request->reservation_id;
    //     return view('qr_code', compact('reservation_id'));
    // }
