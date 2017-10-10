<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use Auth;
use DB;
use App\Friends;


class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function message(Request $request){
        $id = Auth::user()->id;  // curr login user
        //get all friend list
        $frnd_list = DB::table(DB::raw('(select u.id,u.first_name,u.last_name,u.profile_image,u.Account_activate from friends as f inner join users as u on f.receiver_id =u.id or f.sender_id=u.id WHERE f.sender_id="'.$id.'" and f.status="accepted" and f.action="friend" or f.receiver_id = "'.$id.'" and f.status= "accepted" and f.action="friend") as t'))->get();
        
        if($frnd_list) {                                     //if friend list not blank
            $first_userid = @$frnd_list[0]->id;             // first user-id of friend 
            if($first_userid == $id) {                      // if first user and curr user are same then get next user id
                $first_userid = @$frnd_list[1]->id;
            }
        } 

        if($request->user_id) {                             //if particular user     
          $first_userid = $request->user_id;  
        }

        $getChat =  $this->getChatHistory($id,$first_userid,null);    //get chat of first user or particular user

        if(isset($request)) {
            return view('user.message')->with(['message_class' => 'active', 'frnd_list' => $frnd_list, 'chat_user' => $request->user_id, 'chat_history' => $getChat, 'first_userid' => $first_userid]);
        } else {
            return view('user.message')->with(['message_class' => 'active', 'frnd_list' => $frnd_list, 'chat_history' => $getChat, 'first_userid' => $first_userid]);
        }
    }

    public function sendMessage(Request $request) {
       $id = Auth::user()->id;                                        // current login user
       $request['sender_id'] = $id;                                   //add sender id in array
       unset($request['_token']);                                     //remove token from array
       Chat::create($request->all());                                 //insert msg into database
       //get all msgs
       return $this->getChatHistory($id, $request->receiver_id,null);    //here null is last msg id
    }

    public function getUserChat(Request $request) {
        $id = Auth::user()->id;          // curr login user
        return $this->getChatHistory($id, $request->receiver_id, null);   //here null is last msg id
    }


    public function getRealTImeChat(Request $request) {
        $id = Auth::user()->id;          // curr login user
        $count = Chat::where(['sender_id' => $request->receiver_id , 'receiver_id' => $id, 'status' => 'unread'])->count();

        //if chat has any unread msg 
        if($count > 0) {
        	$data = $this->getChatHistory($id, $request->receiver_id, null);       //here null is last msg id
        	return $data."[:::]".$request->receiver_id;                            //receive id is concat for to check current user and return received id  
        }
    }

    public function changeMsgStatus(Request $request) {
        $id = Auth::user()->id; 
        Chat::Where(['receiver_id' => $id, 'sender_id' => $request->receiver_id])->update(['status' => 'read']);
    }


    public function getPreviousChat(Request $request) {
    	$id = Auth::user()->id; 
    	return $this->getChatHistory($id, $request->receiver_id, $request->last_id);
    }

}
