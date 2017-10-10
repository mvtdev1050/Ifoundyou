<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Setting;
use App\User;
use DB;
use App\PageCms;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use DateTime;
use Mail;
use App\Mail\AdmintoUser;
use App\Template;
use Session;


class AdminController extends Controller
{
    //

  public function login(Request $request)
   {
     return view('admin.login');
   }

   public function admin_dashboard()
    {
        $TotalPages = PageCms::count();
        $TotalUsers = User::where('user_type','1')->count();
        return view('admin.dashboard')->with(['TotalPages'=>$TotalPages,'TotalUsers'=>$TotalUsers]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/admin')->with('custom_success','Logout Successfully.');
    }

    public function profile()
        {
           $data = User::where('id',Auth::user()->id)->select('*')->first();
            return view('admin.profile')->with(['data'=>$data]);
        }

        public function profile_information(Request $request)
        {
            
            User::where('id',Auth::user()->id)->update(array('first_name'=>$request->first_name,'last_name'=>$request->last_name));
            return redirect('/admin/profile')->with('custom_success','Update Successfully.');
        }

       public function admin_image(Request $request)
        {
            if(Input::file())
            {
                $file = Input::file('file');
                $id = Auth::user()->id;
                $image_previous = User::where('id',$id)->select('profile_image')->first();
                if (isset($image_previous) && $image_previous->profile_image != '') {
                    if(file_exists(public_path().'/assets/images/'.$image_previous->profile_image)) {
                      unlink(public_path().'/assets/images/'.$image_previous->profile_image);             
                  }
              }
                $filename  = time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('assets/images/'. $filename);
                Image::make($file->getRealPath())->save($path);
                User::where('id',Auth::user()->id)->update(array('profile_image'=>$filename));
                return redirect('/admin/profile')->with('custom_success','Profile Image Update Successfully');
            }
            else
            {
                return redirect('/admin/profile')->with('custom_success','Profile Image Update Successfully');
            }    
        } 

       public function checkAdminPassword(Request $request)
        {
            $password=md5($request->password);
            $admin_id=Auth::user()->id;
            $record=DB::table('users')->where('id',$admin_id)->where('md5_password',$password)->get()->first();
            if(!empty($record))
            {
               echo '{ "valid": true }';die;
            }
            else
            {
               echo '{ "valid": false }';die;
            }
        }

       public function change_pass(Request $request)
        {
            $admin_id=Auth::user()->id;
            $new_pass=bcrypt($request->new_password);
            $record=User::where('id',$admin_id)->update(array('password'=>$new_pass));
            return redirect('/admin/profile')->with('custom_success','Password Change Successfully');
        }


        public function how_it_works(Request $request)
    {
        $records=DB::table('how_it_works')->where('type',1)->get();
        $records1=DB::table('how_it_works')->where('type',0)->get();
        return view('admin.how_it_works')->with('records',$records)->with('records1',$records1);
    }

    public function edit_how_it_works(Request $request)
    {
        if(!empty($request->title)){
            DB::table('how_it_works')->where('id',$request->id)->update(array('title'=>$request->title,'desc'=>$request->desc,'icon'=>$request->icon));
            return redirect('admin/how_it_works')->with('custom_success','Update Successfully');
        }
        else
        {
            $records=DB::table('how_it_works')->where('id',$request->id)->get()->first();
            return view('admin.edit_how_it_works')->with('record',$records);
        }
    }

    public function add_how_it_works(Request $request)
    {
  

        if(!empty($request->title))
        {
            DB::table('how_it_works')->insert(array('title'=>$request->title,'desc'=>$request->desc,'type'=>$request->type,'icon'=>$request->icon));
            return redirect('admin/how_it_works')->with('custom_success','Add Successfully');
        }
        else
        {
            return view('admin.add_how_it_works');
        }
    }

    public function about_us(Request $request)
    {
        if(!empty($request->our_mission))
        {
           // DB::table('about_us')->where('id',1)->update($request->all());
            return redirect('/admin/about_us')->with('custom_success','Updated Successfully');
        }
        else
        {
          //  $about_us=DB::table('about_us')->get()->first();
            return view('admin.about_us');
        }
    }

     public function contact_us(Request $request)
    {
        if(!empty($request->lat))
        {
            DB::table('contact_us')->where('id',1)->update($request->all());
            return redirect('/admin/contact_us')->with('custom_success','Updated Successfully');
        }
        else
        {
            $contact_us=DB::table('contact_us')->get()->first();
            return view('admin.contact_us')->with('record',$contact_us);
        }
    }

    public function ContactUsCustomers(Request $request)
    {
        $records=DB::table('contact_us')->get();
        return view('admin.contact_us_customers')->with('records',$records);
    }

    public function testimonials(){
        $testimonials=DB::table('testimonials')->get();
        return view('admin.testimonials')->with('testimonials',$testimonials);
    }

    public function addTestimonials(Request $request)
    {
        if(Input::file())
        {
            $file = Input::file('file');
            $filename  = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('images/' . $filename);
            Image::make($file->getRealPath())->save($path);
            DB::table('testimonials')->insert(array('image'=>$filename,'heading'=>$request->heading,'content'=>$request->content));
            return redirect('/admin/testimonials')->with('custom_success','Added Successfully');
        }
        else
        {
            DB::table('testimonials')->insert(array('heading'=>$request->heading,'content'=>$request->content));
            return redirect('/admin/testimonials')->with('custom_success','Added Successfully');
        }
    }

    public function deleteTestimonial(Request $request)
    {
        DB::table('testimonials')->where('id',$request->item_id)->delete();
        return redirect('/admin/testimonials')->with('custom_success','Deleted Successfully');
    }

     public function settingsPage()
    {
        if (Auth::check()) {
          $id = Auth::user()->id;
          $data = Setting::where('admin_id',$id)->select('admin_id','site_logo','site_title','footer_setting')->first();
          return view('admin.settingsPage')->with(['data'=>$data]);
        }
       
    }

    public function saveSettings(Request $request)
    {
      if (Auth::check()) {
        $id = Auth::user()->id;
        if (isset($id) && $id != '') {
         if (Input::file()){
          $id = Auth::user()->id;
          $image_previous = Setting::where('admin_id',$id)->select('site_logo')->first();
          if (isset($image_previous) && $image_previous->site_logo != '') {
            if(file_exists(public_path().'/assets/images/'.$image_previous->site_logo)) {
              unlink(public_path().'/assets/images/'.$image_previous->site_logo);             
            }
          }
          $file = Input::file('site_logo');
          $filename  = time() . '.' .$file->getClientOriginalExtension();
          $path = public_path('assets/images/'. $filename);
          $img = Image::make($file->getRealPath());
             // $img->fit(300,200);
          $img->save($path);
          $data = Setting::where('admin_id',$id)->update([
            'site_logo' => $filename
            ]);
        }
        $data = Setting::where('admin_id',$id)->update([
          'site_title' =>$request->site_title,
          'footer_setting' =>$request->footer_setting
          ]);
        return redirect('/admin/settings')->with('custom_success','Updated Successfully.');
      }
    }
  }

   public function CmsPages()
   {
    $data =  PageCms::select('*')->get();
    return view('admin.allCmsPages')->with(['data'=>$data]);
   } 

    public function AddCmsPage()
   {
    $temp = Template::select('id','template_name','template_file')->get();
    return view('admin.AddCmsPage')->with(['temp'=>$temp]);
   } 
   public function SaveCmsPage(Request $request)
   {
     $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'publish_the_page' =>'required'
        ]);
     if (isset($request->title) && $request->title != '') {

            $slug=trim($request->title);
            $slug= strtolower($slug);
            $slug= str_replace(' ', '-', $slug);
            $slug= preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
            $checkSLug= PageCms::where('slug','like','%'.$slug.'%')->select('title')->exists();
            if($checkSLug=='true'){
              $slug=$slug.'-1';
            }
     }
      $menu = implode(',', $request->menu);

     PageCms::create([
             'title'       => $request->title,
             'description' => $request->description,
             'slug'        => $slug,                         
             'publish'=>$request->publish_the_page,
             'menu' =>$menu,
             'order_number'=>$request->order_number,
             'template_id' =>$request->template
        ]);
    return redirect('/admin/all_cms_pages')->with(['custom_success'=>'Successfully added the page']);
 } 

 public function deleteCmsPage($id)
  {
    PageCms::where('id',$id)->delete();
    return redirect('/admin/all_cms_pages')->with(['custom_success'=>'No page Found !!']);
  }
   public function editCmsPage(Request $request)
   {
    $id = $request->id;
    if (isset($id) && $id !='') {
        $temp = Template::select('id','template_name','template_file')->get();
      $data =  PageCms::where('id',$id)->select('*')->first();
      return view('admin.editCmsPage')->with(['data'=>$data,'temp'=>$temp]);
    }
   }
   public function updateCmspage(Request $request)
   {
    //dd($request->all());
    $id = $request->pageId;
    $menu = implode(',', $request->menu);
    if (isset($id) && $id != '') {
        $data = PageCms::where('id',$id)->update([
          'title'        => $request->title,
             'description' => $request->description,
             'slug'        => $request->slug,                         
             'publish'=>$request->publish_the_page,
             'menu' =>$menu,
             'order_number'=>$request->order_number,
             'template_id' =>$request->template
          ]);
         return redirect('/admin/all_cms_pages')->with(['custom_success'=>'Successfully added the page']);
    }

   }

   public function ShowUsers()
   {
    $data = User::where('user_type','1')->get();
    return view('admin.list-users')->with('data',$data);
   }
   public function deleteUsers(Request $request)
   {
    User::where('id',$request->user_id)->delete();
    return redirect('/admin/users')->with(['custom_success'=>'Successfully deleted the user !!']);
   }
   public function EditUsers(Request $request)
   {
    $id = base64_decode($request->id);
    if (isset($id) && $id !='') {
      $data =  User::where('id',$id)->select('*')->first();
      return view('admin.edit_user')->with(['data'=>$data]);
    }
   }
   public function updateUser(Request $request)
   {
   //dd($request->all());
    $id = $request->user_id;
    $data  = User::where('id',$id)->select('profile_image')->first();
    if (isset($id) &&  $id != '') {
      if (Input::file()){
        $image_previous = User::where('id',$id)->select('profile_image')->first();
                if (isset($image_previous) && $image_previous->profile_image != '') {
                    if(file_exists(public_path().'/assets/images/'.$image_previous->profile_image)) {
                      unlink(public_path().'/assets/images/'.$image_previous->profile_image);             
                  }
              }

              $file = Input::file('change_image');
              $filename  = time() . '.' .$file->getClientOriginalExtension();
              $path = public_path('assets/images/'. $filename);
              $img = Image::make($file->getRealPath());
               $img->save($path);
               $data = User::where('id',$id)->update([
                 
        'profile_image'=>$filename
        ]);

      }
        $data = User::where('id',$id)->update([
        'first_name'        => $request->first_name,
        'last_name' => $request->last_name,
        'email'        => $request->email,                         
        ]);
        return redirect('/admin/users')->with(['custom_success'=>'Successfully added the page']);
    }
   }

   public function ShowUserSavepage()
   {
   if (Auth::check() && Auth::user()->user_type == 2 ) {
       return view('admin.add_user');
    }   
   }

   public function saveNewUser(Request $request)
   {
      $this->validate($request,[
          'first_name' => 'required',
          'last_name' => 'required',
          'username'  =>'required',
          'email' => 'required|email|unique:users'
        ]);
      if ($request->email != '') {
        $password = str_random(10);
        $data = User::create([
          'username' =>$request->username,
          'first_name' =>$request->first_name,
          'last_name'  =>$request->last_name,
          'user_type' =>1,
          'email' =>$request->email,
          'confirmed'=>1,
          'password'=> bcrypt($password)
          ]);
        // \Mail::to($request->email)->send(new AdmintoUser($password,$data));
         return redirect('/admin/users');
      }

   }

}
