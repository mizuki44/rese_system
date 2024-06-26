<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $reserve_info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reserve_info)
    {
        $this->reserve_info = $reserve_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //メールの設定を記述、下記のSendTestMail.php参考
        // https://qiita.com/hinako_n/items/ff451ec558abefc41247
        return $this->view('mail.contact')
            ->subject('メッセージを受け付けました')
            ->from('info@rese.com', '予約サイトRese')
            ->subject('予約リマインドメール')
            ->with(
            'reserve_info',
            $this->reserve_info
        );
    }
}
