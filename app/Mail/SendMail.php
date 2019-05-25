<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('admin::email_templates.normal_mail');  
        //attachments
        if ($this->data['attachments']) {
            $data = explode(',', $this->data['attachments']);

            if (count($data) > 0) {
                foreach ($data as $file) {
                    $email->attach(public_path(rtrim($file, '/')));
                }
            }
        };
        return $email;
    }
}
