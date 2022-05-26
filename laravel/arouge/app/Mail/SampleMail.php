<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SampleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $data = null)
    {
        // 引数で受け取ったデータを変数にセット
        $this->data = $data;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $from = "test@arouge.co.jp";
        $subject = "テストメール";
        $view = $this->template;

        return $this->from($from)->subject($subject)->view($view)->with(['data' => $this->data]);
    }
}
