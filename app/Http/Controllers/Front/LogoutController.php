<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LogoutController extends Controller
{


    public function logout(){
        try{
            Auth::logout();
            Session::forget('coupon');
            return redirect()->route('main.home');
        }catch(\Exception $ex){
            return $ex;
        }
    }
}
