<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PageCms;
use App\ContactUs;
use Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class PageController extends Controller
{
	public function PageView($slug){

		$page = PageCms::where('slug',$slug)->first();
		if(isset($page->template_id) && $page->template_id != '' && $page->template_id == 2){
			return view('templates.contact-us')->with(['page'=>$page]);
		}
		return view('page')->with('page', $page);
	}
    
    public function saveContactUs(Request $request)
    {
    	$url = $request->url;
    	ContactUs::create($request->all());
    	$to = "bhavjot@revinfotech.com";
    	$subject = "contact information";
    	$message = "<table><tr><td>Name</td><td>".$request->name."</td></tr><tr><td>Email</td><td>".$request->email."</td></tr><tr><td>Message</td><td>".$request->message."</td></tr><tr><td>Contact NO.</td><td>".$request->contact_no."</td></tr></table>";
        $mail = $this->send_mail($to, $message, $subject);

    	if($mail){
    		return redirect('/'.$url)->with('custom_success','Message has been sent. we will contact you shortly.');
    	}else {
    		return redirect('/'.$url)->with('custom_error','Something went wrong');
    	}
    	
    }
    
}
