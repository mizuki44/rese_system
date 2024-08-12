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
use App\Models\User;
use App\Models\Favorite;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\AddShopRequest;
use App\Http\Traits\Content;
use App\Consts\SortOptConst;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReserveRequest;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // 予約情報を保存
    public function store(ReserveRequest $request)
    {
        $form = $request->all();
        $item = Reservation::create($form);
        $back_url = url("/detail/{$item->shop_id}");

        return view('reserve_done', compact('item', 'back_url', 'form'));
    }

    // 予約削除
    public function destroy(Request $request)
    {
        $id = $request->reservation_id;
        $item = Reservation::where('id', $id)->delete();
        if ($item) {
            return redirect('my_page');
        } else {
            return redirect('my_page');
        }
    }

    // 予約変更ページ表示
    public function edit(Request $request)
    {
        $id = $request->reservation_id;
        $reserve = Reservation::find($id);
        $today = Carbon::now()->format('Y-m-d');
        $today_time = Carbon::now()->addHour()->format('H:i');

        return view('reserve_edit', compact('id', 'reserve', 'today', 'today_time'));
    }

    // 予約変更
    public function update(ReserveRequest $request)
    {
        $form = $request->all();
        $id = $request->reservation_id;
        $item = Reservation::find($id)->update($form);

        if ($item) {
            return redirect('my_page');
        } else {
            return redirect('my_page');
        }
    }

    // QRコード読み取り
    public function QrCodeUpdate(string $reservation_id)
    {
        Reservation::find($reservation_id)->update(['visited_flg' => true]);
        return redirect('/');
    }
}
