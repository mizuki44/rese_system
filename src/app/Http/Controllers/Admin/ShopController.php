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

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = Shop::all();

        return view('admin.shop_list', compact('shops'));
    }

    public function create(Request $request)
    {
        $areas = Area::all();
        $genres = Genre::all();

        return view('admin.shop_create', compact('areas', 'genres'));
    }

    public function store(Request $request)
    {
        $shop = shop::create([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);
        // $shop = new Shop;

        // name属性が'thumbnail'のinputタグをファイル形式に、画像をpublic/avatarに保存
        $image_path = $request->file('thumbnail')->store('public/avatar/');

        // 上記処理にて保存した画像に名前を付け、userテーブルのthumbnailカラムに、格納
        $shop->image_url = basename($image_path);

        $shop->save();


        return redirect('admin/shop/index');
    }
    // 店舗情報変更フォーム表示
    public function edit(Request $request)
    {
        // dd($request);
        $shop = $request->shop_id;
        $item = Shop::find($shop);

        return view('admin.shop_edit', compact('item'));
    }

    // 店舗情報変更処理
    public function update(Request $request)
    {
        $form = $request->all();
        $id = $request->shop_id;
        $item = Shop::find($id)->update($form);


        if ($item) {
            return redirect('admin/shop/index');
        } else {
            # TODO エラーメッセージ出す
            return redirect('admin/shop/index');
        }
    }

    // 店舗情報削除
    public function delete(Request $request)
    {
        // dd($request);
        $id = $request->shop_id;
        // dd($id);
        $item = Shop::where('id', $id)->delete();
        // dd($item);
        if ($item) {
            return redirect('admin/shop/index');
        } else {
            # TODO エラーメッセージ出す
            return redirect('admin/shop/index');
        }
    }
}
