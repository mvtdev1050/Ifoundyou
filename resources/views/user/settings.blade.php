@extends('layouts.app')

@section('content')
<div class="container-high">
    <div class="row">
        @include('layouts.dashboardsidebar')
          @if(Session::has('ecode'))
          @if(Session::get('ecode') == 2)
          <?php $class = 'alert-info';  ?>
          @elseif(Session::get('ecode') == 0)
          <?php $class = 'alert-danger';  ?>
          @else
          <?php $class = 'alert-success';  ?>
          @endif
          @endif
          @if(Session::has('custom_message'))
          <div class="alert {{ $class }}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <span>{{ Session::get('custom_message') }}</span>
          </div>
          @endif
        <div class="col-md-10 profile-area">
                <div class="col-md-9 col-sm-9 settings-left">
                  <div class="inner-white">
                    <form class="form-horizontal" id="SettingForm" role="form" method="POST" action="{{ url('/updatesettings') }}">
                      {{ csrf_field() }}

                      <h3 class="form-heading"><i class="fa fa-cog fa-lg" aria-hidden="true"></i>Settings</h3>

                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-3 control-label">Name</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="username" value="{{ $data->username }}" required>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email" class="col-md-3 control-label">Email</label>
                      
                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                      
                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div> -->

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-3 control-label">Current Password</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                          <label for="newpassword" class="col-md-3 control-label">New password</label>

                          <div class="col-md-6">
                              <input id="newpassword" type="password" class="form-control" name="newpassword">

                              @if ($errors->has('newpassword'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('newpassword') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-3 margin-200">
                            <button type="submit" class="btn btn-primary site-button">
                                Save
                            </button> 
                        </div>
                    </div>

                     </form>
                  </div>
              </div>
              <div class="col-md-3 col-sm-3 setting_right">
                <div class="inner-white">
                
                  @if(Auth::user()->Account_activate == 'deactivate')
                   <span onclick="activate({{ Auth::user()->id }})"><i class="fa fa-ban fa-2x" aria-hidden="true"></i><p>Activate</p></span>
                   @else
                   <span onclick="deactivate({{ Auth::user()->id }})"><i class="fa fa-ban fa-2x" aria-hidden="true"></i><p>Deactivate</p></span>
                  @endif
             
                 
                  <span><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i><p>Delete</p></span>
                </div>
              </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
          $('#SettingForm').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'Field is required',
            icon: 
            {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields:
            {
                
                "email": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          },
                          emailAddress: {
                            message: 'The value is not a valid email address'
                        }
                      }
                  },
            }
        })
    });
function deactivate(id){
  location.href="{{ url('/user/deactivate')}}/"+id;
}
function activate(id){
  location.href="{{ url('/user/activate')}}/"+id;
}
</script>

@endsection