<?php
namespace App\common\helpers;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Ddeboer\Imap\Message;

class MessageOtherDetails extends Message {

    public static function disposition($attachment) {
        return $attachment->structure->disposition;
    }
    
    public static function getToName($message) {
        $from = $message->getFrom();
        $name = $from->getName();
        if(empty($name)){
            $name = $from->getMailbox();
        }
        return $name;
    }

}
