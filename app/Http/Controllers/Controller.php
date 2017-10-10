<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Chat;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function send_mail($to_email, $send_data, $subject) {
        $to      =  $to_email;
        $subject =  $subject;
        $message =  $send_data;
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .=  'Content-type: text/html; charset=iso 8859-1'."\r\n";
        $headers .= 'From: Ifoundyou <no-reply@Ifoundyou.com>' . "\r\n";
        return $result= mail($to, $subject, $message, $headers);
   }

   public function getChatHistory($sender_id, $receiver_id,$getPreviousChatId) {

   	/* 
   	if getPreviousChatId is not nulll then get msg from last id of chat
   	otherwise get last 15 msg of chat for selected user and auth user
   	*/
   if($getPreviousChatId != null) {
        $getMsg = Chat::where([ 'sender_id' => $sender_id, 'receiver_id' => $receiver_id])->where('id', '<', $getPreviousChatId)->orWhere(['sender_id' => $receiver_id, 'receiver_id' => $sender_id])->where('id', '<', $getPreviousChatId)->orderBy('id','desc')->limit(15)->get()->reverse();
    } else {
       $getMsg = Chat::where([ 'sender_id' => $sender_id, 'receiver_id' => $receiver_id])->orWhere(['sender_id' => $receiver_id, 'receiver_id' => $sender_id])->orderBy('id','desc')->take(15)->get()->reverse();
    }

        $div = '';
        $msg_date = '';
       foreach ($getMsg as $key => $msg) {                  			//foreach 

            if($msg->sender_id == $sender_id) {							//get sender msgs
                $msg_class1 = 'send_box';
                $msg_class2 = 'ch2';
            } else {  													//get Receiver msgs
               $msg_class1 = 'reply_box';
               $msg_class2 = 'ch1';               
            }

            //msgs html content
            if($msg_date != date_format(date_create($msg->created_at),"Y-m-d")) {				
                $msg_date = date_format(date_create($msg->created_at),"Y-m-d");
                if(date_format(date_create($msg->created_at),"Y-m-d") == date('Y-m-d')) {           //if msg date and current date are same then print today in date
                     $div.= "<div class='chat_day'><span>Today</span></div>";
                } else if(date_format(date_create($msg->created_at),"Y-m-d") == date("Y-m-d", strtotime("yesterday"))) {   //if msg date is past of current date (yesterday) 
                    $div.= "<div class='chat_day'><span>Yesterday</span></div>";
                } else {																									// if msg date is before current date 
                    $div.= "<div class='chat_day'><span>".date_format(date_create($msg->created_at),"l, F d, Y")."</span></div>";
                }
            } 
            $div.= '<div id="'.$msg->id.'" class="'.$msg_class1.' user_chat">';
            $div.=     '<div class="'.$msg_class2.'">';
            $div.=         '<span>'.$msg->message.'</span>';
            $div.= 		   '<span class="chat_time">'.date_format(date_create($msg->created_at),"h:i a ").'</span>';
            $div.=     '</div>';
            $div.= '</div>';
       }  //endforeach
      return $div;
   }
}
