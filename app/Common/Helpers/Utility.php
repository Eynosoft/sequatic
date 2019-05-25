<?php

namespace App\common\helpers;

use Illuminate\Support\Facades\Mail;

class Utility {

    public static function sendMail($data) {
    switch ($data['request']) {
            case "forgot_password":
                $email_data = $data;
                Mail::send('backend::email_templates.forgot-password', ['data'=>$data], function ($message) use ($email_data) {
                    $message->to($email_data['email'])
                            ->subject($email_data['subject']);
                });
                break;
            
            case "new_user_creation":
                $email_data = $data;
                Mail::send('backend::email_templates.new-user', ['data'=>$data], function ($message) use ($email_data) {
                    $message->to($email_data['email'])
                            ->subject($email_data['subject']);
                });
                break;

            case "send_normal_mail":
                $email_data = $data;
                Mail::send([], [], function ($message) use ($email_data) {
                    $message->to($email_data['email'])
                            ->subject($email_data['subject'])
                            ->setBody($email_data['email_body'], 'text/html');
                    if ($email_data['attachments']) {
                        $data = explode(',', $email_data['attachments']);

                        if (count($data) > 0) {
                            foreach ($data as $file) {
                                $message->attach(public_path(rtrim($file, '/')));
                            }
                        }
                    }
                });
                break;

            default:
                echo "default case123";
        }
        return true;
    }
    
    public static function getFileName($file){
        
        $array = explode('/', $file);
        end($array);
        $key = key($array);
        return isset($array[$key]) ? $array[$key] : '';
    }
    
}
