<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgetForm(Request $request) {
        $count  =  User::where('email',$request->email)->count();
        if($count > 0) {
            $msg = 'Hello, <br>';
            $user = User::where('email',$request->email)->first();
            $msg.= 'Please click on link to reset password. <a href=http://'.$_SERVER['HTTP_HOST'].'/reset-password'.'/'.$user->id.'>Click here to reset</a>';
            $data = $this->send_mail($request->email,$msg,'Reset Password Email');
            return back()->with('custom_message','We have e-mailed your password reset link!')->with('ecode', '1');
        } else {
            return back()->with('custom_message','These credentials do not match our records.')->with('ecode', '0');
        }
    }
}
