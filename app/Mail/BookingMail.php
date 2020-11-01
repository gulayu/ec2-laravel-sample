<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        // 引数のデータをセット
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bgshop.flyer@gmail.com')
                    ->subject('来店ご予約ありがとうございます | ボードゲーム ショップフライヤー')
                    ->view('mail.booking')
                    ->with(['content' => $this->content]);
    }
}
