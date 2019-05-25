<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class SendNormalEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailer = new SendMail($this->data);
        Mail::to($this->data['email'])->queue($mailer);
//        ,function($message){
//            $message->from('nwambachristian@gmail.com', 'Christian Nwmaba');
////            $message->to('dylan16taylor@gmail.com');
        //});
        
        //$mailer = new SendMail($data);
        //Mail::to($this->user->email)->send($email);
//        $mailer->queue('admin::email_templates.normal_mail', $this->data, function ($message) {
//            $message->from('nwambachristian@gmail.com', 'Christian Nwmaba');
//            $message->to('dylan16taylor@gmail.com');
//        });
    }
}
