<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = Admin::get();
        return view('admin.owner_list', compact('admins'));
    }

    public function create(Request $request)
    {
        return view('admin.owner_create');
    }

    public function store(Request $request)
    {

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);



        return redirect('admin/owner');
    }

    public function edit(Request $request)
    {
        return view('index');
    }

    public function update(Request $request)
    {
        return view('index');
    }

    public function delete(Request $request)
    {
        return view('index');
    }
}
