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
    // マイページ表示
    public function create()
    {
        $user_id = Auth::id();
        $reservations = $this->getRreservedShops($user_id);
        $favorites = Favorite::select()->UserSearch($user_id)->get();
        $tomorrow = Carbon::now()->addDay()->format('Y-m-d');
        $shops = Shop::query();
        return view('my_page', compact('reservations', 'favorites', 'tomorrow','shops'));
    }

    // 予約店舗情報を取得
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
                'number' => $reservation->number,
                'visited_flg' => $reservation->visited_flg
            );
            $reserved_shops[] = $reserve_info;
            $reservation_num++;
        }
        return $reserved_shops;
    }

    // QRコード表示
    public function showQrCode(Request $request)
    {
        $reservation_id = $request->reservation_id;
        return view('qr_code', compact('reservation_id'));
    }
}
