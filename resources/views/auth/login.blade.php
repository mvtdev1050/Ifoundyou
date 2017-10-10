@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row login-page">
        <div class="panel panel-default">
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
                <strong>Success ! </strong>
                <span>{{ Session::get('custom_message') }}</span>
            </div>
            @endif
            <h3 class="main-heading">Login</h3>
            <div class="panel-body">
                <form class="form-horizontal" id="Login_form" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-2 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-2 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group" style="display: none;">
                        <div class="col-md-9 col-md-offset-2">
                            <div class="checkbox left">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                            <a class="btn btn-link right" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-2">
                            <button type="submit" class="btn btn-primary site-button">
                                Login
                            </button> 
                            <a href="{{ url('/')}}" class="btn btn-primary site-button">Cancel </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(){
          $('#Login_form').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'This value is not valid',
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
                        },
                      }
                  },
                  "password": 
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

        })
    </script>
@endsection
