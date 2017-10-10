@extends('layouts.layout_admin')
@section('title')
     Admin Profile
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')
<div id="navbar-search" class="navbar-search collapse">
  <div class="navbar-search-inner">
    <form action="#">
      <span class="search-icon"><i class="fa fa-search"></i></span>
      <input class="search-field" type="search" placeholder="search..."/>
    </form>
    <button type="button" class="search-close" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
      <i class="fa fa-close"></i>
    </button>
  </div>
  <div class="navbar-search-backdrop" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false"></div>
</div>
<main id="app-main" class="app-main">
  <div class="wrap">
    <section class="app-content">
            <div class="row">
                    <div class="col-md-12">
                         @if (session('custom_success'))
                         <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Success ! </strong>
                            <span>{{ Session::get('custom_success') }}</span>
                          </div>
                          @endif
                           @if (session('custom_error'))
                         <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Error ! </strong>
                            <span>{{ Session::get('custom_error') }}</span>
                          </div>
                          @endif
                        <!-- BEGIN PROFILE SIDEBAR -->
                        <div class="profile-sidebar" style="width:250px;">
                            <!-- PORTLET MAIN -->
                            <div class="portlet light profile-sidebar-portlet">
                                <!-- SIDEBAR USERPIC -->
                                <div class="profile-userpic">
                                         @if(!empty($data->profile_image ))
                                        <img  class="img-responsive" src="{{ asset('/public/assets/images/')}}/<?= $data->profile_image; ?>" alt="">
                                 @else
                                    <img src="{{ asset('/public/assets/images/1481282093.png')}}" class="img-responsive" alt="">
                                    @endif
                                </div>
                                <!-- END SIDEBAR USERPIC -->
                                <!-- SIDEBAR USER TITLE -->
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name">
                                         <?= Auth::user()->first_name; ?>
                                    </div>
                                    <div class="profile-usertitle-job">
                                        Admin
                                    </div>
                                </div>
                                <div class="profile-usermenu">
                                    <ul class="nav">
                                       
                                        <li class="active">
                                            <a href="javascript:void(0);">
                                            <i class="icon-settings"></i>
                                            Account Settings </a>
                                        </li>
                                       
                                    </ul>
                                </div>
                                <!-- END MENU -->
                            </div>
                           
                        </div>
                        <!-- END BEGIN PROFILE SIDEBAR -->
                        <!-- BEGIN PROFILE CONTENT -->
                        <div class="profile-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet light">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold ">Profile Account</span>
                                            </div>
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_1_1" data-toggle="tab" aria-expanded="true">Personal Info</a>
                                                </li>
                                                <li class="">
                                                    <a href="#tab_1_2" data-toggle="tab" aria-expanded="false">Change Avatar</a>
                                                </li>
                                                <li class="">
                                                    <a href="#tab_1_3" data-toggle="tab" aria-expanded="false">Change Password</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="tab-content">
                                                <!-- PERSONAL INFO TAB -->
                                                <div class="tab-pane active" id="tab_1_1">
                                                    <form id="loginForm" role="form" action="{{ url('admin/profile-information')}}" method="Post">
                                                        <div class="form-group">
                                                            <label class="control-label">First Name</label>
                                                            <input placeholder="First Name" value="<?= Auth::user()->first_name ?>" name="first_name" class="form-control" type="text">
                                                        </div>
                                                       {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label class="control-label">Last Name</label>
                                                            <input placeholder="Last Name" value="<?= Auth::user()->last_name ?>" name="last_name" class="form-control" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Username</label>
                                                            <input value="<?= Auth::user()->username ?>" readonly class="form-control" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Email</label>
                                                            <input  value="<?= Auth::user()->email ?>" readonly class="form-control" type="text">
                                                        </div>
                                                        <div class="margiv-top-10">
                                                            <input type="submit" value="Save Changes" class="btn green-haze" /> 
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- END PERSONAL INFO TAB -->
                                                <!-- CHANGE AVATAR TAB -->
                                                <div class="tab-pane" id="tab_1_2">
                                                    
                                                    <form enctype= multipart/form-data action="{{ url('admin/admin_image')}}" role="form" method="Post">
                                                    {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                               @if(!empty($data->profile_image ))
                                                               <div class="fileinput-new thumbnail" style="width: 155px; height: 150px;">
                                                                  <img src="{{ asset('/public/assets/images')}}/{{ $data->profile_image }}" alt="">
                                                              </div>
                                                              @else
                                                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                  <img src="{{ asset('/public/assets/images/1481282093.png')}}" alt="">
                                                              </div>
                                                              @endif
                                                           
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                                </div>
                                                                <div>
                                                                    <span class="btn default btn-file">
                                                                    <span class="fileinput-new">
                                                                    Select image </span>
                                                                    <span class="fileinput-exists">
                                                                    Change </span>
                                                                    <input name="file" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                                                    Remove </a>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="margin-top-10">
                                                            <input type="submit" value="Submit" class="btn green-haze" name="admn_img">
                                                            <!-- <a href="#" class="btn green-haze">
                                                            Submit </a>
                                                             -->
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- END CHANGE AVATAR TAB -->
                                                <!-- CHANGE PASSWORD TAB -->
                                                <div class="tab-pane" id="tab_1_3">
                                                     <form id="changePasswordForm" role="form" action="{{ url('admin/change_pass')}}" method="Post">
                                                      {{ csrf_field() }}
                                                       <!--  <div class="form-group">
                                                            <label class="control-label">Current Password</label>
                                                            <input class="form-control" value="" name="password" type="password">
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label class="control-label">New Password</label>
                                                            <input class="form-control" value="" name="new_password" type="password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Re-type New Password</label>
                                                            <input class="form-control" name="re_password" type="password">
                                                        </div>
                                                        <div class="margin-top-10">
                                                            <input type="submit" value="Change Passsword" class="btn green-haze" /> 
                                                           
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- END CHANGE PASSWORD TAB -->
                                                <!-- PRIVACY SETTINGS TAB -->
                                                <div class="tab-pane" id="tab_1_4">
                                                    <form action="#">
                                                        <table class="table table-light table-hover">
                                                        <tbody><tr>
                                                            <td>
                                                                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
                                                            </td>
                                                            <td>
                                                                <label class="uniform-inline">
                                                                <div class="radio"><span><input name="optionsRadios1" value="option1" type="radio"></span></div>
                                                                Yes </label>
                                                                <label class="uniform-inline">
                                                                <div class="radio"><span class="checked"><input name="optionsRadios1" value="option2" checked="" type="radio"></span></div>
                                                                No </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                 Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                            </td>
                                                            <td>
                                                                <label class="uniform-inline">
                                                                <div class="checker"><span><input value="" type="checkbox"></span></div> Yes </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                 Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                            </td>
                                                            <td>
                                                                <label class="uniform-inline">
                                                                <div class="checker"><span><input value="" type="checkbox"></span></div> Yes </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                 Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                            </td>
                                                            <td>
                                                                <label class="uniform-inline">
                                                                <div class="checker"><span><input value="" type="checkbox"></span></div> Yes </label>
                                                            </td>
                                                        </tr>
                                                        </tbody></table>
                                                        <!--end profile-settings-->
                                                        <div class="margin-top-10">
                                                            <a href="#" class="btn green-haze">
                                                            Save Changes </a>
                                                            <a href="#" class="btn default">
                                                            Cancel </a>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- END PRIVACY SETTINGS TAB -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE CONTENT -->
                    </div>
                </div>
    </section>
</div>
</main>
@endsection
@section('css')
<link href="{{ asset('public/assets/css/profile.css') }}" rel="stylesheet">
<link href="{{  asset('public/assets/css/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
<style type="text/css">
    #app-main
    {
        margin-top: 90px !important;
    }
</style>
@endsection
@section('script')
<script src="{{ asset('public/assets/js/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#loginForm').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'This value is not valid',
            icon: 
            {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            err: 
            {
                container: 'popover'
            },
            fields:
            {
                "first_name": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'First Name is required'
                          }
                      }
                  },
                  "last_name": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Last Name is required'
                          }
                      }
                  }
            }
        })
    });


$(document).ready(function(){
 $('#changePasswordForm').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'This value is not valid',
            icon: 
            {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            err: 
            {
                container: 'popover'
            },
            fields:
            {
                 "password": 
                 {
                        validators: 
                        {
                            notEmpty: 
                            {
                                message: 'Current password is required'
                            },
                            remote: {
                                message: 'This password is not the password of admin, please enter valid password.',
                                url: '{{url("/admin/checkAdminPassword")}}',
                                type: 'Get',
                                delay: 1000     // Send Ajax request every 2 seconds
                            }
                        }
                    },
                "new_password": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'New Password is required'
                          }
                      }
                  },
                "re_password": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Re-type Password is required'
                          },
                            identical: {
                                field: 'new_password',
                                message: 'Password and its confirm are not the same'
                            }
                      }
                  }
            }
        })
});
</script>
@endsection