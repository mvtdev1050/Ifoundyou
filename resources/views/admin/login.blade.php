@extends('layouts.layout_login')
@section('title')
     Login
@stop
@section('content')
<style type="text/css">
    .simple-page-logo
    {
        margin-bottom: 45px;
    }
</style>
    <div class="simple-page-wrap">
        <div class="simple-page-logo animated swing">
            <a href="index.html">
                <span><img style="width:37%" src="{{ Site_logo() }}"></span>
            </a>
        </div><!-- logo -->
        <div class="simple-page-form animated flipInY" id="login-form">
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
            <h4 class="form-title m-b-xl text-center" id="form-title">Sign In With Your Admin Account</h4>
            <form action="{{ url('/login') }}" method="post" id="login_form_main">
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input name="email" type="email" class="form-control" placeholder="Email">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input  type="password" name="password" class="form-control" placeholder="Password">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

               
                <input type="hidden" value="2" name="user_type">
                <input type="hidden" name="admin" value="1">
                <input type="submit" class="btn btn-primary" value="SIGN IN">
            </form>
           
        </div><!-- #login-form -->

       
    </div><!-- .simple-page-wrap -->
@endsection

@section('script')
    <script> 
      
    </script>
@endsection