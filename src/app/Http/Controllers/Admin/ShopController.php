<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopCreateRequest;


class ShopController extends Controller
{
    // 店舗一覧表示
    public function index(Request $request)
    {
        $shops = Shop::all();

        return view('admin.shop_list', compact('shops'));
    }


    // 店舗情報新規作成フォーム表示
    public function create(Request $request)
    {
        $areas = Area::all();
        $genres = Genre::all();

        return view('admin.shop_create', compact('areas', 'genres'));
    }

    // 店舗情報新規作成
    public function store(ShopCreateRequest $request)
    {
        $shop = shop::create([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        // S3へファイルをアップロード
        $result = Storage::disk('s3')->put('/', $request->file('image_url'));
        $url = Storage::disk('s3')->url($result);
        $shop->image_url = $url;
        $shop->save();

        return redirect('admin/shop/index');
    }

    // 店舗情報変更フォーム表示
    public function edit(Request $request)
    {
        $shop = $request->shop_id;
        $item = Shop::find($shop);

        return view('admin.shop_edit', compact('item'));
    }

    // 店舗情報変更処理
    public function update(ShopCreateRequest $request)
    {
        $form = $request->all();
        $id = $request->shop_id;
        $item = Shop::find($id)->update($form);

        if ($item) {
            return redirect('admin/shop/index');
        } else {
            return redirect('admin/shop/index');
        }
    }

    // 店舗情報削除
    public function delete(Request $request)
    {
        $id = $request->shop_id;
        $item = Shop::where('id', $id)->delete();
        if ($item) {
            return redirect('admin/shop/index');
        } else {
            return redirect('admin/shop/index');
        }
    }
}
