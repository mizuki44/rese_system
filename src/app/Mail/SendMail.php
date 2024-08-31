<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $info, $view, $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info, $view, $subject)
    {
        $this->info = $info;
        $this->view = $view;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)
            ->from('info@rese.com', '予約サイトRese')
            ->subject($this->subject)
            ->with(
                'info',
                $this->info
            );
    }
}
