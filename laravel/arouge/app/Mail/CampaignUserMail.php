<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $data, $q_data)
    {
        // 引数で受け取ったデータを変数にセット
        $this->data = $data;
        $this->q_data = $q_data;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $from = "www-info@zenyaku.co.jp";
        $subject = "キャンペーン応募有難う御座いました";
        $view = $this->template;

        return $this->from($from)->subject($subject)->view($view)->with(['data' => $this->data, 'q_data' => $this->q_data]);
    }
}
