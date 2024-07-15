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
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // お知らせメール送信フォーム表示
    public function create(Request $request)
    {
        $users = User::all();

        return view('admin.mail_send', compact('users'));
    }
    // お知らせメール送信
    public function send(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendMail($request->content, 'mail.info', $request->title));
        }

        return redirect('admin/index');
    }
}
