<?php

namespace App\common\helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class User {

    public static function getFullName() {
        if (self::checklogin()) {
            if (Auth::guard('backend')->user()) {
                return ucwords(Auth::guard('backend')->user()->first_name . ' ' . Auth::guard('backend')->user()->last_name);
            }
            return false;
        }
    }

    public static function getRoleName() {
        if (self::checklogin()) {
            if (Auth::guard('backend')->user()) {
                return ucwords(Auth::guard('backend')->user()->role->role);
            }
            return false;
        }
    }

    public static function checkLogin() {
        if (Auth::guard('backend')->check()) {
            return true;
        }
        return false;
    }

    public static function getId() {
        if (self::checklogin()) {
            if (Auth::guard('backend')->user()) {
                return Auth::guard('backend')->user()->id;
            }
            return false;
        }
    }

}
