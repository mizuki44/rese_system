<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Reservation;
use App\Mail\SendMail;      //Mailableクラス
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '(test) send mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        $today_format = $today->format('Y-m-d');
        // whereで、Reservation.dateとtomorrow_formatが一致するものを検索
        $reservations = Reservation::where('date', $today_format)->get();


        // 今日の日付と同じ日付の予約をとってくる
        foreach ($reservations as $reservation) {
            // $reservationの関連のユーザーをとってくる（メルアドが知りたいから）
            // ユーザーのメアド宛にメール送信する
            $user_mail = $reservation->user->email;
            $reserve_info = array(
                'user_name' => $reservation->user->name,
                'shop_name' => $reservation->shop->name,
                'date' => $reservation->date,
                'time' => $reservation->time,
                'number' => $reservation->number,
            );

            Mail::to($user_mail)->send(new SendMail($reserve_info, 'mail.contact', '予約リマインドメール'));
            // Mailebleファイルを使って、メール送信処理を記述
            // https://qiita.com/hinako_n/items/ff451ec558abefc41247
            // のMailController.phpを参考
        }
    }
}
