<?php

namespace App\Http\Controllers\Auth;
use Session;
use App\User;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'zipcode' => 'required|min:5'
        ]);
    }

    public function register(Request $request) {

        $day = $request->day;
        $month = $request->month;
        $year = $request->year;
        $date = $day.'-'.$month.'-'.$year;
        $dob =  date("m/d/Y", strtotime($date));
        $this->validator($request->all())->validate();
        $user = $this->create($request->all(), $dob);
        $user->activation_code; 
        $to = $user->email;
        $subject = "Verification Mail";
        $message = "Thanks for creating an account with the Ifound Application.
        Please follow the link below to verify your email address<br/>";
        $message .= "<a href='".url('/')."/register/verify/" . $user->activation_code."'>Activate Account</a>";

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
        $headers .= "From: ifoundu@ifoundutest.com\r\n";
        $headers .= "Reply-To: ifoundu@ifoundutest.com\r\n";
        $headers .= "Return-Path: ifoundu@ifoundutest.com\r\n";
       // $mail =  mail($to, $subject, $message, $headers);
        $mail = $this->send_mail($to,$message,$subject);

        return redirect('/register')->with(['custom_message'=>'Please check your email for verification','ecode'=>2]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data, $dob)
    {

          return User::create([
            'username' => $data['name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'dob' => $dob,
            'cafe' => $data['cafe'],
            'zipcode' => $data['zipcode'],
            'dobnumber' => DobSum($dob),
            'user_type' => $data['user_type'],
            'password' => bcrypt($data['password']),
            'simple_pass' => md5($data['password']),
            'Account_activate'=>'activate',
            'confirmed'=> 0,
            'activation_code' => str_random(30),
        ]);

    }

    public function confirmuser($code){
         $confirmation_code = $code;
        
         if($confirmation_code && $confirmation_code!=''){

            $user = User::where('activation_code', $confirmation_code)->first();
            if(!$user){
                return redirect('/register')->with(['custom_message'=>'User Does not exist','ecode'=>0]);
            }
            else {

              $user->confirmed = 1;
              $user->activation_code = null;
              $user->save();  

              return redirect('/login')->with(['custom_message'=>'your account has been activated successfully, Please login now.','ecode'=>1]);

            }
         }
    }

    public function getCafes(Request $request){
        if(!empty($request->key)){
           $cafe = DB::table('cafe')->select('Store_Name','id')->where('ZipCode','like','%'.$request->key.'%')->get();
            if(!empty($cafe)){
                $html = "<option value='null'>Select Cafe</option>";
                foreach ($cafe as $key => $value) {
                    $html.="<option value=".$value->id.">".$value->Store_Name."</option>" ;
                }    
            }
           echo $html; 
        }
    }
}
