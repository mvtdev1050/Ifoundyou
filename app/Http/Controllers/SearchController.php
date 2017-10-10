<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\UserLocation;
use App\Notification;
use App\Friends;
use App\Cafe;
use App\UserPhotos;
use App\Privacy;

class SearchController extends Controller
{
    //
    /*public function searchResults(){
    	return view('searchresults');
    }*/


    public function searchDetails($id){
    	$user = User::where('id',$id)->with('location')->first();   //get search user detail
        $user_photo = UserPhotos::where('user_id',$id)->get();      //get user's all photos
        $friends = Friends::where(['sender_id' => $id, 'action' => 'friend'])->with('getApprovedFriends')->orWhere(['receiver_id' => $id, 'action' => 'friend'])->with('getSendRequestUser')->get();
        $privacy = Privacy::where('user_id',$id)->first();
        //if user is logged in
    	if(Auth::check()) {
    		$curr_user_id = Auth::user()->id;
    		$send_request = Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $id, 'action' => 'send_request'])->orWhere(['receiver_id' => $curr_user_id, 'sender_id' => $id, 'action' => 'send_request'])->count();
    		$accept_request = Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $id, 'action' => 'friend'])->orWhere(['receiver_id' => $curr_user_id, 'sender_id' => $id, 'action' => 'friend'])->count();
    		if($send_request > 0) {
    			$data = Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $id, 'action' => 'send_request'])->orWhere(['receiver_id' => $curr_user_id, 'sender_id' => $id, 'action' => 'send_request'])->first();
    		} else if($accept_request > 0) {
    			$data = Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $id, 'action' => 'friend'])->orWhere(['receiver_id' => $curr_user_id, 'sender_id' => $id, 'action' => 'friend'])->first();
    		} else {
    			$data = Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $id])->orWhere(['receiver_id' => $curr_user_id, 'sender_id' => $id])->first();
    		}

    		if($data) {
    			if($data->action == 'send_request') {
    				if($curr_user_id == $data->sender_id) {
    					return view('searchdetails',['user' => $user, 'user_photo' => $user_photo, 'friends' => $friends, 'privacy' => $privacy,  'sent_request' => 'yes']);	
    				} else {
    					return view('searchdetails',['user' => $user, 'user_photo' => $user_photo, 'friends' => $friends, 'privacy' => $privacy,  'pending_request' => 'yes']);	
    				}
    			} else if($data->action == 'friend') {
    				return view('searchdetails',['user' => $user, 'user_photo' => $user_photo, 'friends' => $friends, 'privacy' => $privacy,  'friend' => 'yes']);    
    			} else {
    				if($curr_user_id == $data->sender_id) {
    					return view('searchdetails',['user' => $user, 'user_photo' => $user_photo, 'friends' => $friends, 'privacy' => $privacy,  'bookmark' => 'yes']);  
    				} else {
    					return view('searchdetails',['user' => $user, 'user_photo' => $user_photo, 'friends' => $friends, 'privacy' => $privacy ]);	
    				}
    			}
            } else {
            	return view('searchdetails',['user' => $user, 'user_photo' => $user_photo, 'friends' => $friends, 'privacy' => $privacy ]);	
            }
    	} else {  // user is not logged in
    		return view('searchdetails',['user' => $user, 'user_photo' => $user_photo, 'friends' => $friends, 'privacy' => $privacy]);	
    	}
    }

    public function searchResults(Request $request) {

        if($request->day) {
            $day = $request->day;
            $month = $request->month;
            $year = $request->year;
            $date = $day.'-'.$month.'-'.$year;
            $dob =  date("m/d/Y", strtotime($date)); 
           $data = DobSum((string)$dob);
           $userData = User::where(['dobnumber' => $data, 'Account_activate' => 'activate'])->with('location')->paginate(10);
           return view('searchresults',['userData' => $userData]);
        } else if($request->first_name || $request->last_name) {
            $userData = User::where('first_name','like','%'.$request->first_name.'%')->where('last_name','like','%'.$request->last_name.'%')->where('Account_activate','activate')->paginate(10);
            return view('missing',['userData' => $userData]);
        } else if ($request->zip_code){
           $cafe = Cafe::where('ZipCode','like','%'.$request->zip_code.'%')->with('getCafeUser')->get();
          // $cafe = json_encode($cafe,true);
           return view('searchzip',['cafe' => $cafe]);
        } else {
            return back();
        }
    }

    public function sendRequest(Request $request) {
        $curr_user_id = Auth::user()->id;
        if($request->send_request) {
            $action = 'send_request';
        } else if($request->unbookmark){
            $action = 'unbookmark';
            Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id, 'action' => 'bookmark'])->delete();
            Notification::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id, 'action' => 'bookmark'])->delete();
            return back();  
        } else {
            $action = 'bookmark';
        }
        //if user had already bookmark to another person then change status when user again send him to request        
        $count = Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id])->count();
        if($count > 0) {
           Notification::create([
            'sender_id' => $curr_user_id,
            'receiver_id' => $request->receiver_id,
            'action' => $action
            ]);
           Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id])->update([
            'action' => $action
            ]);
        } else {         // if user send a request to another person
            Notification::create([
                'sender_id' => $curr_user_id,
                'receiver_id' => $request->receiver_id,
                'action' => $action
                ]);
            Friends::create([
                'sender_id' => $curr_user_id,
                'receiver_id' => $request->receiver_id,
                'action' => $action
                ]);
        }
        return back();
    }

    public function cancelRequest(Request $request) {
    	$curr_user_id = Auth::user()->id;
        Notification::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id])->orWhere(['receiver_id' => $curr_user_id, 'sender_id' => $request->receiver_id])->delete();
        Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id])->orWhere(['receiver_id' => $curr_user_id, 'sender_id' => $request->receiver_id])->delete();
        
        /*$count = Notification::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id, 'action' => 'send_request'])->count();
        if($count > 0) {
            Notification::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id])->delete();
            Friends::where(['sender_id' => $curr_user_id, 'receiver_id' => $request->receiver_id])->delete();
        }
        $count2 = Notification::where(['sender_id' => $request->receiver_id, 'receiver_id' => $curr_user_id, 'action' => 'send_request'])->count();
        if($count2 > 0) {
            Notification::where(['sender_id' => $request->receiver_id, 'receiver_id' => $curr_user_id])->delete();
            Friends::where(['sender_id' => $request->receiver_id, 'receiver_id' => $curr_user_id])->delete();
        }*/

        return back();
    }


    public function missingPerson() {
        return view('missing');
    }
}
