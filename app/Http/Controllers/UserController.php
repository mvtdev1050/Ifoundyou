<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\UserLocation;
use Auth;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\UserPhotos;
use App\Notification;
use App\Friends;
use App\Privacy;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){

        $id = Auth::user()->id;
        $data = User::where('id',$id)->first();
    	return view('user.profile')->with(['user' => $data, 'profile_class' => 'active']);
    }

    public function edit(){

        $id = Auth::user()->id;
        $data = User::where('id',$id)->first();
    	return view('user.edit')->with('user',$data);	
    }

    public function UpdateUser(Request $request){
  
         $day = $request->day;
         $month = $request->month;
         $year = $request->year;
         $date = $day.'-'.$month.'-'.$year;
         $dob =  date("m/d/Y", strtotime($date)); 
       // echo date_format(date_create($request->dob),"m/d/Y"); die;

        $id = Auth::user()->id;

        $data = array('username' => $request->username, 'email'=>$request->email, 'dob'=> $dob, 'gender'=>$request->gender,'about'=>$request->about,'activity'=>implode(', ', $request->activity), 'ethnicity'=> $request->ethnicity, 'body_type'=>$request->body_type,'height'=>$request->height,'eye_color'=>$request->eye_color, 'hair_color'=>$request->hair_color,'friends'=>$request->friends, 'phone' => $request->phone);   

        if ($request->hasFile('profile_image')) {
            //check if already image exists then unlink it.
           $image_previous = User::where('id',$id)->select('profile_image')->first();
           if (isset($image_previous) && $image_previous->profile_image != '') {
                if(file_exists(public_path().'/assets/images/users/'.$image_previous->profile_image)) {
                  unlink(public_path().'/assets/images/users/'.$image_previous->profile_image);             
                }
            }
          //check if already image exists then unlink it.
            $file = $request->file('profile_image'); 
            $filename  = time() . '.' .$file->getClientOriginalExtension(); 
            $path = public_path('assets/images/users/'. $filename); 
            $img = Image::make($file->getRealPath());
            $img->fit(171,171);
            $img->save($path);
            $data['profile_image'] = $filename;
        }

        User::where('id',$id)->update($data);
        return redirect('/dashboard');

    }

    public function settings(){

        $id = Auth::user()->id;
        $data = User::select('id','username','email')->where('id',$id)->first();
    	return view('user.settings')->with(['data' => $data, 'setting_class' => 'active']);	
    }

    public function UpdateSettings(Request $request){

        $id = Auth::user()->id;
        $user = User::select('id')->where('simple_pass',md5($request->password))->where('id',$id )->first();
        if(!empty($user)){

            if($request->newpassword != '') {
                $data = array('username'=>$request->username,'password'=> bcrypt($request->newpassword), 'simple_pass'=> md5($request->newpassword));
            } else {
                $data = array('username'=>$request->username,);
            }

            $useer = DB::table('users')->where('id', $id)->update($data);
           
           if($useer){
            return redirect('/user/settings')->with(['custom_message'=>'Settings Updated','ecode'=>1]); 
           }
           
        }
        else {
            return redirect('/user/settings')->with(['custom_message'=>'Password does not matched','ecode'=>0]);   
        }
        
    }

    public function notification(){
        $id = Auth::user()->id;
        $data = Notification::where(['receiver_id' => $id])->where('action','!=','bookmark')->with('getUser')->paginate(10);
    	return view('user.notification',['data' => $data, 'notify_class' => 'active']);	
    }

    public function notificationStatus(Request $request) {
        
        if($request->notify) {
            $notify = $request->notify;
            foreach ($notify as  $value) {
                Notification::where('id',$value)->update(['status'=>$request->status]);
            }
        }
        return back();
    }


    public function location(){ 

        $id = Auth::user()->id;
        $data = UserLocation::select('location','address')->where('uid',$id)->first();

    	return view('user.location')->with(['data' => $data, 'location_class' => 'active']);	
    }
    public function UpdateSaveLocation(Request $request){
        
        $ids = Auth::user()->id;
        $id = DB::table('user_location')->select('uid')->where('uid',$ids)->first();  
        if(empty($id)){
             $location = UserLocation::create($request->all());
             return back()->with(['custom_message'=>'Location Added','ecode'=>1]);
        }
        else
        {
            $location = DB::table('user_location')->where('uid',$ids)->update(['location'=> $request->location,'address' => $request->address,'updated_at'=>Carbon::now()]);
             return back()->with(['custom_message'=>'Location Updated','ecode'=>1]);
        }
        
          
    }


    public function DeactivateUser($id){
            $user = User::find($id);
            $user->Account_activate = 'deactivate';
            $user->save();
            Friends::where(['sender_id' => $id, 'action' => 'bookmark'])->orWhere(['receiver_id' => $id, 'action' => 'bookmark'])->delete();
            Notification::where(['sender_id' => $id, 'action' => 'bookmark'])->orWhere(['receiver_id' => $id, 'action' => 'bookmark'])->delete();
            Auth::logout();
            return redirect('/login')->with(['custom_message'=>'Your account has been deactivated. you can activate it anytime.','ecode'=>2,'status'=>'deactivate']);
    }    

    public function ActivateUser($id){
            $user = User::find($id);
            $user->Account_activate = 'activate';
            $user->save();

            return redirect('user/settings')->with(['custom_message'=>'Your account has been activated.','ecode'=>2,'status'=>'activate']);
    }
    

    public function faq(){
    	return view('user.faq');	
    }

    public function friendRequest(){
       $id = Auth::user()->id;
       $frnd_rqst =Friends::where(['receiver_id' => $id, 'action' => 'send_request', 'status' => 'pending'])->with('getSendRequestUser')->paginate(5);
       $frnd_list = DB::table(DB::raw('(select u.id,u.first_name,u.last_name,u.profile_image,u.Account_activate from friends as f inner join users as u on f.receiver_id =u.id or f.sender_id=u.id WHERE f.sender_id="'.$id.'" and f.status="accepted" and f.action="friend" and f.sender_id != u.id or f.receiver_id = "'.$id.'" and f.status= "accepted" and f.action="friend" and f.receiver_id != u.id) as t'))->get();
       $mutual_frnd = Friends::where(['receiver_id' => $id, 'action' => 'friend'])->orWhere(['sender_id' => $id, 'action' => 'friend'])->get();
       $array[] = $id;
       foreach ($mutual_frnd as $value) {
          if($value->sender_id == $id) {
            $array[] = $value->receiver_id;
          } else {
            $array[] = $value->sender_id;
          }
       }

       $know_frnds  = User::whereNotIn('id', $array)->Where('user_type',1)->inRandomOrder()->limit(6)->get();

    	return view('user.friend-request', ['frnd_rqst' => $frnd_rqst, 'frnd_list' => $frnd_list, 'frnd_class' => 'active', 'know_frnds' => $know_frnds]);	
    }


    public function frnd_rqst(Request $request) {
       if($request->accepted) {
            Friends::where(['sender_id' => $request->sender_id, 'receiver_id' => $request->receiver_id])->update(['action' => 'friend', 'status' => 'accepted']);
            Notification::where(['sender_id' => $request->sender_id, 'receiver_id' => $request->receiver_id])->update(['status' => 'hide']);
            Notification::create(['sender_id' => $request->receiver_id, 'receiver_id' => $request->sender_id, 'action' => 'approved' ]);
        } else {
            Friends::where(['sender_id' => $request->sender_id, 'receiver_id' => $request->receiver_id])->delete();   
             Notification::where(['sender_id' => $request->sender_id, 'receiver_id' => $request->receiver_id])->delete();
        }
        return back();
    }

    public function bookmark(){
       $id = Auth::user()->id;
       $data = Friends::where(['sender_id' => $id, 'action' => 'bookmark'])->with('getUser')->paginate(10);

       return view('user.bookmark',['data' => $data, 'bookmark_class' => 'active']);	
    }

    public function activities(){
    	return view('user.activites');	
    }

    public function testimonial(){
    	return view('user.testimonial');	
    }

    public function subscription(){
    	return view('user.subscription')->with('subs_class','active');	
    }

    public function privacy(Request $request){
        $id = Auth::user()->id;
        if($request->email_privacy) {
             unset($request['_token']);   
            $count = Privacy::where('user_id', $id)->count();
            if($count > 0) {
                Privacy::where('user_id', $id)->update([
                    'email_privacy' => $request->email_privacy,
                    'phone_privacy' => $request->phone_privacy,
                    'photos_privacy' => $request->photos_privacy,
                    'friends_privacy' => $request->friends_privacy
                ]);
                return back()->with('custom_success','Your privacy settings successfully updated.');
            } else {
                Privacy::create([
                    'user_id' => $id,
                    'email_privacy' => $request->email_privacy,
                    'phone_privacy' => $request->phone_privacy,
                    'photos_privacy' => $request->photos_privacy,
                    'friends_privacy' => $request->friends_privacy
                ]);
                return back()->with(['custom_message'=>'Your privacy settings successfully saved.','ecode'=>1]);
            }
        } else {
            $data = Privacy::where('user_id', $id)->first();
    	   return view('user.privacy')->with('privacy_class','active')->with('data',$data);	
        }
    }


     public function photos(){
        $id = Auth::user()->id;
        $photos = UserPhotos::where('user_id',$id)->orderBy('id', 'desc')->limit(10)->get();
        return view('user.photos',['photos' => $photos, 'photo_class' => 'active']);
    }

    public function uploadPhotos(Request $request){

        if($request->file('image')){
            $id = Auth::user()->id;
            $file = $request->file('image'); 
            $filename  = time() . '.' .$file->getClientOriginalExtension(); 
            $largeImage  = time() . '.' .$file->getClientOriginalExtension(); 
            $path = public_path('assets/images/user_photos/'. $filename); 


            if($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'jpeg') {
                $src = imagecreatefromjpeg($file->getRealPath());
            } 
            else if($file->getClientOriginalExtension() == 'png') {
                $src = imagecreatefrompng($file->getRealPath());
            } 
            else {
                $src = imagecreatefromgif($file->getRealPath());
            }

            list($width,$height)=getimagesize($file);
            $newwidth=233;
            $newheight=233;
            $tmp=imagecreatetruecolor($newwidth,$newheight);
            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
            imagejpeg($tmp,$path,100);

            $desinationPath = public_path('assets/images/user_large_photos/');
            $file->move($desinationPath, $largeImage);
            /*$img = Image::make($file->getRealPath());
            $img->resize(233,233);
            $img->save($path);
            
            $path2 = public_path('assets/images/user_large_photos/'. $largeImage); 
            $img2 = Image::make($file->getRealPath());
            $img2->save($path2);*/
            UserPhotos::create([
                'user_id' => $id,
                'photos'  => $filename
                ]);
            return redirect('user/photos');
        } else {
            return back();
        }
    }

    public function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file->getRealPath());
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return $dst;
    }

    public function deletePhotos(Request $request){
        UserPhotos::where('id',$request->photo_id)->delete();
        return redirect('user/photos');
    }
}
