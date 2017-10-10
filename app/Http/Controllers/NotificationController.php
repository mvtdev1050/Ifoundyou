<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\UserLocation;
use App\Notification;
use App\Friends;
use App\Chat;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotification(){
      $user_id = Auth::user()->id;
                      //echo $data = DB::table('notification')->where(['receiver_id' => $user_id, 'status' => 'unread'])->where('action','<>','bookmark')->toSql();
      $notify = Notification::where(['receiver_id' => $user_id, 'status' => 'unread'])->where('action','<>','bookmark')->count();
      $bookmark_notify = Friends::where(['sender_id' => $user_id, 'action' => 'bookmark'])->count();
      $frnd_notify = Friends::where(['receiver_id' => $user_id, 'action' => 'send_request'])->count();
      $msg_notify = Chat::where(['receiver_id' => $user_id, 'status' => 'unread'])->count();
      $myObj['notify'] = $notify;
      $myObj['bookmark_notify'] = $bookmark_notify;
      $myObj['frnd_notify'] = $frnd_notify;
      $myObj['msg_notify']  = $msg_notify;
      return $myJSON = json_encode($myObj);
    }
}
