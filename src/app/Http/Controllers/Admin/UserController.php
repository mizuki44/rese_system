<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\MailSendRequest;

class UserController extends Controller
{
    // お知らせメール送信フォーム表示
    public function create(Request $request)
    {
        $users = User::all();

        return view('admin.mail_send', compact('users'));
    }
    // お知らせメール送信
    public function send(MailSendRequest $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendMail($request->content, 'mail.info', $request->title));
        }

        return redirect('admin/index');
    }
}
