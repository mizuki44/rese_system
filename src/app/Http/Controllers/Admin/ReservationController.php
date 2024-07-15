<?php

namespace App\Http\Controllers\Admin;

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
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::all();
        $tomorrow = Carbon::now()->addDay()->format('Y-m-d');

        return view('admin.reserve_list', compact('reservations', 'tomorrow'));
    }

    public function edit(Request $request)
    {
        $reservations = Reservation::all();

        return view('admin.reserve_list', compact('reservations'));
    }

    public function update(Request $request)
    {

        $form = $request->all();
        $id = $request->reservation_id;
        $item = Reservation::find($id)->update($form);

        if ($item) {
            return redirect('admin/reserve');
        } else {
            # TODO エラーメッセージ出す
            return redirect('admin/reserve');
        }

    }


    // 予約削除
    public function delete(Request $request)
    {
        // dd($request);
        $id = $request->reservation_id;
        // dd($id);
        $item = Reservation::where('id', $id)->delete();
        // dd($item);
        if ($item) {
            return redirect('admin/reserve');
        } else {
            # TODO エラーメッセージ出す
            return redirect('admin/reserve');
        }
    }
}