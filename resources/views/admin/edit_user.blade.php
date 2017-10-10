@extends('layouts.layout_admin')
@section('title')
Edit Page
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')
<main id="app-main" class="app-main">
  <div class="wrap">
    <section class="app-content">
      <div class="ibp_dashboard_cont_inr">
        <div class="ibp_dashboard_cont">
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

        <form id="ProductForm" action="{{ url('/admin/update-user') }}" method="Post" enctype="multipart/form-data">
          <div class="outr_box_shadow">
            {{csrf_field()}}
            <h2 class="h2_product"><span>Edit user</span></h2>
            <div style="margin-top:30px" class="box_shadow_inr col-md-12 col-xs-12 col-sm-12">
             <div class="form-group">
              <label class="control-label">First Name</label>
              <input type="hidden" name="user_id" value="{{ $data->id }}">
              <input placeholder="First Name" value="{{ $data->first_name }}" name="first_name" class="form-control" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Last Name</label>
              <input placeholder="Last Name" value="{{ $data->last_name }}" name="last_name" class="form-control" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Email</label>
              <input placeholder="Email" value="{{ $data->email }}" name="email" class="form-control" type="email">
            </div>
            <div class="form-group">
              <label class="control-label">Username</label>
              <input placeholder="Username" value="{{ $data->username }}" name="username" disabled="disable" class="form-control" type="text">
            </div>
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
                      <input name="change_image" type="file" class="changeButtonFile" name="newfileimage">
                    </span>
                    <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                      Remove </a>
                    </div>
                  </div>

                </div>
              </div>

              <div class="marginBot col-md-12 col-xs-12 col-sm-12">
                <button type="submit" class="btn mw-md btn-primary pull-right">Update</button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </section>
  </div>
</main>

@endsection
@section('css')

<link href="{{  asset('public/assets/css/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
<style type="text/css">

  .box_shadow_inr {
    background-color: #fff;
    border-radius: 3px;
    box-shadow: 3px 9px 9px 2px rgba(0, 0, 0, 0.1);
    margin: 2% 0;
    padding: 15px;
  }
  .outr_box_shadow {
    float: none;
    margin: 0 auto;
    max-width: 700px;
  }
  .h2_product {
    font-size: 22px;
    text-align: center;
  }
  .h2_product span {
    border-bottom: 3px solid #188ae2;
    line-height: 23px;
    padding-bottom: 10px;
  }
  h1, .h1, h2, .h2, h3, .h3 {
    margin-bottom: 10px;
    margin-top: 20px;
  }
  .ibp_dashboard_cont_inr {
    float: none;
    margin: 0 auto;
    max-width: 1200px;
    width: 100%;
  }
  .ibp_dashboard_cont {
    float: left;
    width: 100%;
  }
  h4, .h4
  {
    font-size: 14px;
  }
  .hoverColor:hover
  {
    background-color: #eee;
  }
  .table tr td select {
    width: 117px;
  }
  .table tr td select option {
    padding: 5px;
  }
  .marginBot
  {
    margin-top: 30px;
    margin-bottom: 50px;
  }
  #map {
    height: 100%;
  }
  .mapDiv
  {
    height: 350px;
    width: 100%;
    margin-bottom: 25px;
  }
  .hoverColorChecked
  {
    background-color: #eee;
  }


  .edit_serv_img {
    position: relative;
    text-align: center;
  }
  .padd_5 {
    padding: 5px;
  }
  .padd_left_right_all_zero {
    padding-left: 0;
    padding-right: 0;
  }

  .edit_serv_img .del_gal_img {
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
  }
  .del_gal_img img {
    position: relative;
    top: calc(50% - 10px);
  }
  .edit_serv_img:hover .del_gal_img {
    display: block;
  }
  .floatRight
  {
    height:100px;width:100px;float:right;
  }
</style>
<script src="{{ asset('public/assets/js/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script>
	
	$(document).ready(function() {
   $('#ProductForm').formValidation({
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
          message: 'Field is required'
        }
      }
    },
    "last_name": 
    {
      validators: 
      {
        notEmpty: 
        {
          message: 'Field is required'
        }
      }
    },
     "email": 
    {
      validators: 
      {
        notEmpty: 
        {
          message: 'Field is required'
        }
      }
    },
      "username": 
    {
      validators: 
      {
        notEmpty: 
        {
          message: 'Field is required'
        }
      }
    },

  }
})

 });
</script>

@endsection