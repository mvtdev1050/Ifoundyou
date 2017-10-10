@extends('layouts.layout_admin')
@section('title')
     Settings
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')
<link href="{{  asset('public/assets/css/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
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
        <form id="ProductForm" action="{{ url('/admin/save_settings') }}" method="Post" enctype="multipart/form-data">
        <div class="outr_box_shadow">
        {{csrf_field()}}
          <h2 class="h2_product"><span>Setting </span></h2>
          <div class="col-md-4">
          <h4 class="h4_product">Site logo</h4>
          <div class="form-group">
              <input type="file" name="site_logo" value="{{ $data->site_logo }}" class="form-control" />
            </div>
             @if(!empty($data->site_logo ))
              <div class="fileinput-new thumbnail ">
                  <img src="{{ asset('/public/assets/images')}}/{{ $data->site_logo }}" alt="">
              </div>
              @else
              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="{{ asset('/public/assets/images/1481282093.png')}}" alt="">
              </div>
             @endif
             <h4 class="h4_product">Site title</h4>
            <div class="form-group">
               <input type="text" name="site_title" value=" {{ $data->site_title }}" class="form-control" />
            </div> 
             <h4 class="h4_product">footer setting</h4>
            <div class="form-group">
               <input type="text" name="footer_setting" value=" {{ $data->footer_setting }}" class="form-control" />
            </div> 
            <div class="col-md-4">
              <button type="submit" class="btn mw-md btn-primary pull-right">Submit</button>
          </div>            
          </div>          
          
        </div>
        
      </form>

      </div>
      </div>
  </section>
  </div>
</main>
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
                /* "site_logo": 
                 {
                        validators: 
                        {
                            notEmpty: 
                            {
                                message: 'Field is required'
                            }
                        }
                    },*/
                "site_title": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  },
                  "footer_setting": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  }
            }
        })

	});
</script>

@endsection