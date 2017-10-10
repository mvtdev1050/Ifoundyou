<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function resetPassword($id) {
            return view('auth.passwords.reset')->with('user_id',$id);
    }   

    public function reset(Request $request) {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            ]);
        User::where('id',$request->user_id)->update([
              'password' =>  bcrypt($request->password),
              'simple_pass'=> md5($request->password)
            ]);
        return redirect('/login')->with(['custom_message'=>'Your password has changed. you can login now','ecode'=>'1']);
    } 
}
