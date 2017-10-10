<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PageCms;
use Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
   

    public function showWelcome()
    {
       return view('welcome');
    }
    
    
}
