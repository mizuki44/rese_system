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
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Favorite;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\AddShopRequest;
use App\Http\Traits\Content;
use App\Consts\SortOptConst;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReserveRequest;

class ReservationController extends Controller
{
    public function store(ReserveRequest $request)
    {
        // $this->validate($request, Reservation::$rules);

        // $createReservation = [
        //     'user_id' => $request->user_id,
        //     'shop_id' => $request->shop_id,
        //     'date' => $request->date,
        //     'time' => $request->time,
        //     'number' => $request->number,
        // ];
        // $item = Reservation::c($createReservation);

        $form = $request->all();
        $item = Reservation::create($form);
        // return redirect('/');
        $back_url = url("/detail/{$item->shop_id}");


        return view('reserve_done', compact('item', 'back_url', 'form'));
        // my_pageにも飛ばす？
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
            return view('reserve.done', ['item' => $item]);
        } else {
            return response()->redirect('/');
        }
    }

    // 予約削除
    public function destroy(Request $request)
    {
        $id = $request->reservation_id;
        $item = Reservation::where('id', $id)->delete();
        if ($item) {
            return redirect('my_page');
        } else {
            # TODO エラーメッセージ出す
            return redirect('my_page');
        }
    }

    public function update(Request $request)
    {
        $form = $request->all();
        $id = $request->reservation_id;
        $item = Reservation::find($id)->update($form);

        if ($item) {
            return redirect('my_page');
        } else {
            # TODO エラーメッセージ出す
            return redirect('my_page');
        }
    }

    public function QrCodeUpdate(string $reservation_id)
    {
        Reservation::find($reservation_id)->update(['visited_flg' => true]);
        return redirect('/');
    }
}
