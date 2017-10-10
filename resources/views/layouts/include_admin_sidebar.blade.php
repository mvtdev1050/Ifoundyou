<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)"><img class="img-responsive" src="{{ profile_image() }}" alt="avatar"/></a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
         <!--  <h5><a href="javascript:void(0)" class="username"><?= Auth::user()->first_name ?></a></h5> -->
          <ul>
            <li class="dropdown" id="spaceMange">
              <a style="font-size:20px;" href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <small>Admin</small>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                  <a class="text-color" href="{{ url('/admin/dashboard') }}">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span>Home</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="{{ url('/admin/profile') }}">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>Profile</span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="{{ url('/admin/logout') }}">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span>Logout</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">

        <li class="menu-separator"><hr></li>
        <li>
          <a href="{{ url('/admin/dashboard') }}">
            <i class="menu-icon zmdi zmdi-storage zmdi-hc-lg"></i>
            <span class="menu-text">Dashboard</span>
          </a>
        </li> 
       <li>
          <a href="{{ url('/admin/users') }}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Users</span>
          </a>
        </li>
        
       {{-- <li>
          <a href="{{ url('/admin/takers') }}">
            <i class="menu-icon zmdi zmdi-storage zmdi-hc-lg"></i>
            <span class="menu-text">Takers</span>
          </a>
        </li> 
       
         <li>
          <a href="{{ url('/admin/reviews') }}">
            <i class="menu-icon zmdi zmdi-pages zmdi-hc-lg"></i>
            <span class="menu-text">Reviews</span>
          </a>
        </li> --}}

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
            <span class="menu-text">CMS Pages</span>
          </a>
          <ul class="submenu">
            <li><a href="{{ url('/admin/all_cms_pages') }}"><span class="menu-text">All Pages</span></a></li>
            <li><a href="{{ url('/admin/add_new_page') }}"><span class="menu-text">Add New page</span></a></li>
           {{--  <li><a href="{{ url('/admin/contact_us') }}"><span class="menu-text">Contact us</span></a></li>
            <li><a href="{{ url('/admin/how_it_works') }}"><span class="menu-text">How it works</span></a></li> --}}
          </ul>
        </li>

       {{--  <li>
          <a href="{{ url('/admin/move_sizes') }}">
            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
            <span class="menu-text">Move Sizes</span>
          </a>
        </li>



         <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Services</span>
          </a>
          <ul class="submenu">
            <li><a href="{{ url('/admin/main-items') }}"><span class="menu-text">Moving Services</span></a></li>
           <li class="has-submenu">
            <a href="javascript:void(0)" class="submenu-toggle">
              <span class="menu-text">Cleaning Services</span>
            </a>
            <ul class="submenu">
              <li><a href="{{ url('/admin/house-cleaning-services') }}"><span class="menu-text">House</span></a></li>
              <li><a href="{{ url('/admin/office-cleaning-services') }}"><span class="menu-text">Office</span></a></li>
            </ul>
          </li>
            <li><a href="{{ url('/admin/storage-services') }}"><span class="menu-text">Storage Services</span></a></li>
            <li><a href="{{ url('/admin/transport-services') }}"><span class="menu-text">Truck Driver</span></a></li>

          </ul>
        </li>


         <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-pin zmdi-hc-lg"></i>
            <span class="menu-text">FAQ's</span>
          </a>
          <ul class="submenu">
            <li><a href="{{ url('/admin/taker_faq') }}"><span class="menu-text">For Taker</span></a></li>
            <li><a href="{{ url('/admin/provider_faq') }}"><span class="menu-text">For Provider</span></a></li>
          </ul>
        </li>--}}


        <li>
          <a href="{{ url('/admin/contact_us_customers') }}">
            <i class="menu-icon zmdi zmdi-language-javascript zmdi-hc-lg"></i>
            <span class="menu-text">Contact Customers</span>
          </a>
        </li> 

         
        <!-- Gerenal settings    -->
         <li>
          <a href="{{ url('/admin/settings') }}">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Settings</span>
          </a>
        </li>

      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
  <style type="text/css">
    #spaceMange{margin-top: 10px;}
  </style>
</aside>