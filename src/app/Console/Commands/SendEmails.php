<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Reservation;
use App\Mail\SendMail;
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
    protected $description = 'send mail';

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
        $reservations = Reservation::where('date', $today_format)->get();


        foreach ($reservations as $reservation) {
            $user_mail = $reservation->user->email;
            $reserve_info = array(
                'user_name' => $reservation->user->name,
                'shop_name' => $reservation->shop->name,
                'date' => $reservation->date,
                'time' => $reservation->time,
                'number' => $reservation->number,
            );

            Mail::to($user_mail)->send(new SendMail($reserve_info, 'mail.contact', '予約リマインドメール'));
        }
    }
}
