<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function authenticated($request, $user)
    {
        if($user->confirmed == 0) {
            Auth::logout();
            return redirect('/login')->with(['custom_message'=>'Please activate your email first','ecode'=>'0']);
        }
        else if(!empty($request->admin))
        {
            if($user->user_type == 2){
                return redirect('/admin/dashboard');
            }
            else {
                Auth::logout();
              return redirect('/admin')->with('custom_error','Account not registered as admin');
            }
        }
        else {
            if($user->user_type == 1){     
                if(isset($request->search_details_id)) {
                    return back();
                   //return redirect('/search-details',$request->search_details_id);
                } else {
                    if($user->Account_activate == 'deactivate') {
                        $user->Account_activate = 'activate';
                        $user->save();
                    }
                    return redirect('/dashboard')->with('custom_message','you are successfully logged in');       
                }
            }
            
        }
    }
}
