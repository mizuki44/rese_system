<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\OwnerCreateRequest;

class AdminController extends Controller
{
    // 管理者・店舗代表者一覧ページ表示
    public function index(Request $request)
    {
        $admins = Admin::get();
        return view('admin.owner_list', compact('admins'));
    }

    // 管理者・店舗代表者新規作成フォーム表示
    public function create(Request $request)
    {
        return view('admin.owner_create');
    }

    // 管理者・店舗代表者新規作成
    public function store(OwnerCreateRequest $request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect('admin/owner');
    }

    // 管理者・店舗代表者変更フォーム表示
    public function edit(Request $request)
    {
        return view('index');
    }

    // 管理者・店舗代表者変更
    public function update(Request $request)
    {
        return view('index');
    }

    // 管理者・店舗代表者削除
    public function delete(Request $request)
    {
        return view('index');
    }
}
