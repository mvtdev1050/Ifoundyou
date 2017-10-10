@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/forgetpassword/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
