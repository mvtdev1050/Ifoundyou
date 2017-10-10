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
                <span>{{ Session::get('custom_message') }}</span>
              </div>
            @endif
            <h3 class="main-heading">Sign Up</h3>
            <div class="panel-body">
                <form class="form-horizontal" id="Register_form" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="user_type" value="1">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label">Username</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-2 control-label">First Name</label>

                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-2 control-label">Last Name</label>

                        <div class="col-md-6">
                            <input id="lastname" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-2 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                        <label for="dob" class="col-md-2 control-label">Date Of Birth</label>

                        <div class="col-md-6">
                            <!-- <input id="dob" type="text" class="form-control" name="dob" placeholder="DD/MM/YYYY" value="{{ old('dob') }}" required> -->
                            <select  class="form-control custom-j-class col-md-4 col-sm-4 col-xs-12" name="day" required autofocus>
                             <option value=""> - Day - </option>
                             <?php for($i=1;$i<32;$i++){ ?>
                              <option value="{{ $i }}">{{ $i }}</option>
                              <?php }?>
                            </select>
                            <select  class="form-control custom-j-class col-md-4 col-sm-4 col-xs-12" name="month" required autofocus>
                               <option> - Month - </option>
                              <option value="January">January</option>
                              <option value="Febuary">Febuary</option>
                              <option value="March">March</option>
                              <option value="April">April</option>
                              <option value="May">May</option>
                              <option value="June">June</option>
                              <option value="July">July</option>
                              <option value="August">August</option>
                              <option value="September">September</option>
                              <option value="October">October</option>
                              <option value="November">November</option>
                              <option value="December">December</option>
                            </select>
                            <select  class="form-control custom-j-class col-md-4 col-sm-4 col-xs-12" name="year" required autofocus>
                            <option value=""> - Year - </option>
                             <?php for($i=1980;$i<2006;$i++){ ?>
                              <option value="{{ $i }}">{{ $i }}</option>
                              <?php }?>
                            </select>

                            @if ($errors->has('dob'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                        <label for="zipcode" class="col-md-2 control-label">Zip Code</label>

                        <div class="col-md-6">
                            <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode') }}" required maxlength="5">

                            @if ($errors->has('zipcode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('zipcode') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cafe') ? ' has-error' : '' }}">
                        <label for="cafe" class="col-md-2 control-label">Cafe</label>
                    
                        <div class="col-md-6">
                          <select id="cafe"  class="form-control" name="cafe" required autofocus>
                             <option value="">Select cafe</option>
                          </select>
                           
                            @if ($errors->has('cafe'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cafe') }}</strong>
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

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-2 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-2">
                            <button type="submit" class="btn btn-primary site-button submit-button"> 
                                Save
                            </button>
                            <a href="{{ url('/')}}" class="btn btn-primary site-button">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(){
          $('#Register_form').formValidation({
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
                  },
                  "name": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }

                      }
                  },
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
                  
                "zipcode": {
                    validators: {
                        zipCode: {
                            country: 'US',
                            message: 'The value is not valid %s postal code'
                        },
                        numeric: {
                            message: 'The value is not a number'
                        }
                    }
                }
            }
        })

         $('input[name="zipcode"]').keyup(function(){
           var key = $(this).val();
           if($(this).val().length == 5){
              $.ajax({
              url: "{{ url('/ajax/cafe') }}",
              data: 'key='+ key,
              success: function(res){
              	if(res === ''){
              		$('#cafe').html('<option value="">No cafe found</option>');
              		console.log('its empty');
              	}else {
              		$('#cafe').html(res);	
              	/*	$('#cafe').parent().parent().removeClass('has-error');
              		$('#cafe').parent().parent().addClass('has-success');
              		$('#cafe').next().removeClass('glyphicon glyphicon-remove');
              		$('#cafe').next().addClass('glyphicon glyphicon-ok');
              		$('#cafe').next().show();
              		$('#cafe').next().next().hide();*/
              		console.log('not empty');
              	}
               }
            })	
           } else {
                $('#cafe').html('');
                $('#Register_form').formValidation('revalidateField','cafe');
           } /*else {
	           	$('#cafe').parent().parent().removeClass('has-success');
	           	$('#cafe').parent().parent().addClass('has-error');
	           	$('#cafe').next().removeClass('glyphicon glyphicon-ok');
	           	$('#cafe').next().addClass('glyphicon glyphicon-remove');
	           	$('#cafe').next().show();
	           	$('#cafe').next().next().show();
           		$('#cafe').html('<option value="">No cafe found</option>');
           }*/
           
         }); 

        })
   
    </script>
@endsection
