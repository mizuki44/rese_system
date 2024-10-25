<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopCreateRequest;
use Illuminate\Support\Facades\Validator;


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

    // csvインポート画面表示
    public function pre_import()
    {
        return view('admin.shop_import');
    }
    // csvインポート
    public function import(Request $request)
    {
        if (!($request->hasFile('csvFile'))) {
            return redirect('/admin/shop/import')->with('message', 'ファイルを選択してください');
        }
        $path = $request->file('csvFile')->getRealPath();
        $csvArray = array();
        $firstFlg = true;
        $keys = array();
        $count = 0;
        $file = fopen($path, 'r');
        while ($line = fgetcsv($file)) {
            if ($firstFlg) {
                for ($i = 0; $i < count($line); $i++) {
                    array_push($keys, $line[$i]);
                }
                $firstFlg = false;
            } else {
                for ($i = 0; $i < count($line); $i++) {
                    $csvArray[$count][$keys[$i]] = $line[$i];
                }
                $count++;
            }
        }
        fclose($file);
        $error_list = [];

        foreach ($csvArray as $key => $value) {
            $validator = Validator::make(
                $value,
                ShopCreateRequest::rules_for_csv(),
                ShopCreateRequest::messages_for_csv()
            );
            if ($validator->fails()) {
                $line = $key + 1;
                $err_msg = array_map(fn($message) => "{$line}行目: {$message}", $validator->errors()->all());
                $error_list = array_merge($error_list, $err_msg);
            }
            if (!empty($error_list)) {
                $excep_msg = implode("\n", $error_list);
                return redirect('/admin/shop/import')->with('error', $excep_msg);
            }
            $area_id = Area::where('name', $value['area'])->first()->id;
            $genre_id = Genre::where('name', $value['genre'])->first()->id;

            $shop = new Shop($value);
            $shop->area_id = $area_id;
            $shop->genre_id = $genre_id;
            $shop->save();
        }
        return redirect('/admin/shop/import')->with('success_message', '店舗情報の登録に成功しました。');
    }
}
