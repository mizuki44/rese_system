<?php

namespace App\Http\Controllers;

use Auth;
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
use App\Models\Favorite;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\AddShopRequest;
use App\Http\Traits\Content;
use App\Consts\SortOptConst;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, Reservation::$rules);
        $createReservation = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'people' => $request->people
        ];
        $item = Reservation::create($createReservation);
        return response()->json([
            'data' => $item
        ], 200);
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $item = Reservation::find($id);

        // ショップ名取得
        $shop_id = $item->shop_id;
        $shop = Shop::find($shop_id);
        $item->shopname = $shop->shopname;

        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => '該当のお店が見当たりません'
            ], 404);
        }
    }

}
