@extends('layouts.app')

@section('content')
<div class="container-high">
    <div class="row">
    
        @include('layouts.dashboardsidebar')
        <div class="col-md-10 profile-area">
            <div class="content">
                <div class="profile-des row">
                    <div class="col-md-2 col-sm-2 col-xs-6 profile_pic">
                    @if($user->profile_image == NULL)
                        <img src="{{ asset('/public/assets/images/users/dummymale.jpg')}}" class="profile_display"/>
                    @else
                       <img src="{{ asset('/public/assets/images/users/')}}/{{ $user->profile_image }}" class="profile_display"/>
                    @endif   
                    </div>
                </div>
                <form class="form-horizontal" id="userprofile" method="Post" enctype="multipart/form-data" action="{{ url('/updateuser') }}">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary form-button" id="profile_image">
                                Upload New Photo
                            </button> 
                            <input type="file" name="profile_image" accept="image/*" style="visibility: hidden;">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-2 control-label fix-width-col-2">Username</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="{{ $user->username}}" required autofocus maxlength="20">

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-2 control-label fix-width-col-2">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                        <label for="dob" class="col-md-2 control-label fix-width-col-2">Date Of Birth</label>

                        <div class="col-md-6">
                            <!-- <input id="dob" type="dob" class="form-control" name="dob" placeholder="MM/DD/YYYY"  value="<?php echo date_format(date_create($user->dob),"m/d/Y")?>" required autofocus> -->
                            <select  class="form-control custom-j-class col-md-4 col-sm-4 col-xs-12" name="day" required autofocus>
                             <option value=""> - Day - </option>
                             <?php 
                                $date = date_format(date_create($user->dob),"d"); 
                                $month = date_format(date_create($user->dob),"F"); 
                                $year = date_format(date_create($user->dob),"Y"); 
                            ?>
                             <?php for($i=1;$i<32;$i++){ ?>
                              <option value="{{ $i }}" <?php if($date == $i) { echo 'selected'; }?>>{{ $i }}</option>
                              <?php }?>
                            </select>
                            <select  class="form-control custom-j-class col-md-4 col-sm-4 col-xs-12" name="month" required autofocus>
                               <option> - Month - </option>
                              <option value="January" <?php if($month == 'January') { echo 'selected'; }?>>January</option>
                              <option value="Febuary" <?php if($month == 'Febuary') { echo 'selected'; }?>>Febuary</option>
                              <option value="March" <?php if($month == 'March') { echo 'selected'; }?>>March</option>
                              <option value="April" <?php if($month == 'April') { echo 'selected'; }?>>April</option>
                              <option value="May" <?php if($month == 'May') { echo 'selected'; }?>>May</option>
                              <option value="June" <?php if($month == 'June') { echo 'selected'; }?>>June</option>
                              <option value="July" <?php if($month == 'July') { echo 'selected'; }?>>July</option>
                              <option value="August" <?php if($month == 'August') { echo 'selected'; }?>>August</option>
                              <option value="September" <?php if($month == 'September') { echo 'selected'; }?>>September</option>
                              <option value="October" <?php if($month == 'October') { echo 'selected'; }?>>October</option>
                              <option value="November" <?php if($month == 'November') { echo 'selected'; }?>>November</option>
                              <option value="December" <?php if($month == 'December') { echo 'selected'; }?>>December</option>
                            </select>
                            <select  class="form-control custom-j-class col-md-4 col-sm-4 col-xs-12" name="year" required autofocus>
                            <option value=""> - Year - </option>
                             <?php for($i=1980;$i<2006;$i++){ ?>
                              <option value="{{ $i }}" <?php if($year == $i) { echo 'selected'; }?>>{{ $i }}</option>
                              <?php }?>
                            </select>
                            @if ($errors->has('dob'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label for="gender" class="col-md-2 control-label fix-width-col-2">Gender</label>

                        <div class="col-md-6">
                            
                            <select id="Gender"  class="form-control" name="gender" required autofocus>
                             <option value="">Select Gender</option>
                              <option value="male" @if($user->gender == 'male') {{ 'selected' }} @endif >Male</option>
                              <option value="female" @if($user->gender == 'female') {{ 'selected' }} @endif >Female</option>
                            </select>

                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label for="gender" class="col-md-2 control-label fix-width-col-2">Phone</label>

                        <div class="col-md-6">
                            
                             <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required autofocus maxlength="15">

                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                        <label for="short-desc" class="col-md-11 control-label short-desc">short description</label>

                        <div class="col-md-11">
                            <textarea id="short-desc" class="form-control" name="about"  autofocus>{{ $user->about }}</textarea>

                            @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                        <div class="col-md-12 act">
                            <label for="activity" class="control-label acti-label">Activities</label>
                            <input type="checkbox" name="activity[]" value="all" class="form-control select-all" {{ (in_array('all',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /> Iam up for everything
                        </div>

                        <div class="col-md-11">
                             <ul class="activities">
                                <li><input type="checkbox" name="activity[]" class="form-control" value="Picnic" {{ (in_array('Picnic',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Picnic</span></li>
                                <li><input type="checkbox" name="activity[]" class="form-control"  value="Casino" {{ (in_array('Casino',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Casino</span></li>
                                <li><input type="checkbox" name="activity[]" class="form-control" value="Biking" {{ (in_array('Biking',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Biking</span></li>
                                <li><input type="checkbox" name="activity[]" class="form-control" value="Yoga" {{ (in_array('Yoga',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Yoga</span></li>
                                <li><input type="checkbox" name="activity[]" class="form-control" value="Phone Friend" {{ (in_array('Phone Friend',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Phone Friend</span></li>
                                <li><input type="checkbox" name="activity[]" class="form-control" value="Events" {{ (in_array('Events',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Events</span></li>
                                <li><input type="checkbox" name="activity[]" class="form-control" value="Swimming" {{ (in_array('Swimming',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Swimming</span></li>
                                <li><input type="checkbox" name="activity[]" class="form-control" value="Adventure" {{ (in_array('Adventure',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Adventure</span></li>
                                <li><input type="checkbox" name="activity[]" class="form-control" value="Parties" {{ (in_array('Parties',explode(', ',$user->activity))) ? 'checked="checked" ' : '' }} /><span>Parties</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('ethnicity') ? ' has-error' : '' }}">
                        <label for="ethnicity" class="col-md-2 control-label fix-width-col-2">Ethnicity</label>

                        <div class="col-md-6">
                            <select id="ethnicity"  class="form-control" name="ethnicity" required >
                              <option value="">Select ethnicity</option>
                              <option value="Hot-tempered" @if($user->ethnicity == 'Hot-tempered') {{ 'selected' }} @endif >Hot-tempered </option>
                              <option value="Expressive" @if($user->ethnicity == 'Expressive') {{ 'selected' }} @endif >Expressive</option>
                            </select>

                            @if ($errors->has('ethnicity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ethnicity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('body-type') ? ' has-error' : '' }}">
                        <label for="body-type" class="col-md-2 control-label fix-width-col-2">Body Type</label>

                        <div class="col-md-6">
                            <select id="body-type"  class="form-control" name="body_type" value="" required autofocus>
                             <option value="">Select Body Type</option>
                              <option value="Mesomorph" @if($user->body_type == 'Mesomorph') {{ 'selected' }} @endif>Mesomorph</option>
                              <option value="Endomorph" @if($user->body_type == 'Endomorph') {{ 'selected' }} @endif>Endomorph</option>
                              <option value="Ectomorph" @if($user->body_type == 'Ectomorph') {{ 'selected' }} @endif>Ectomorph</option>
                            </select>

                            @if ($errors->has('body-type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body-type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                        <label for="height" class="col-md-2 control-label fix-width-col-2">Height</label>

                        <div class="col-md-6">
                            <select id="height" class="form-control" name="height" value="" required autofocus>
                             <option  value="">Select height</option>
                              <option value="Height1" @if($user->height == 'Height1') {{ 'selected' }} @endif>Height1</option>
                              <option value="Height2" @if($user->height == 'Height2') {{ 'selected' }} @endif>Height2</option>
                              <option value="Height3" @if($user->height == 'Height3') {{ 'selected' }} @endif>Height3</option>
                            </select>

                            @if ($errors->has('height'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('eye_color') ? ' has-error' : '' }}">
                        <label for="eye_color" class="col-md-2 control-label fix-width-col-2">Eye Color</label>

                        <div class="col-md-6">
                            <select id="eye-color" class="form-control" name="eye_color" value="" required autofocus>
                              <option value="">Select Eye Color</option>
                              <option value="Black" @if($user->eye_color == 'Black') {{ 'selected' }} @endif> Black</option>
                              <option vlaue="Brown" @if($user->eye_color == 'Brown') {{ 'selected' }} @endif> Brown</option>
                              <option value="Grey" @if($user->eye_color == 'Grey') {{ 'selected' }} @endif> Grey</option>
                            </select>

                            @if ($errors->has('eye_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('eye_color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('hair_color') ? ' has-error' : '' }}">
                        <label for="hair-color" class="col-md-2 control-label fix-width-col-2">Hair Color</label>

                        <div class="col-md-6">
                            <select id="hair_color" type="text" class="form-control" name="hair_color"  value="" required autofocus >
                              <option value="">Select Hair Color</option>
                              <option value="Black"  @if($user->hair_color == 'Black') {{ 'selected' }} @endif >Black</option>
                              <option vlaue="Brown"  @if($user->hair_color == 'Brown') {{ 'selected' }} @endif >Brown</option>
                              <option value="Grey"  @if($user->hair_color == 'Grey') {{ 'selected' }} @endif >Grey</option>
                            </select>

                            @if ($errors->has('hair_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hair_color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('friends') ? ' has-error' : '' }}">
                        <label for="friends" class="col-md-2 control-label fix-width-col-2">Friends with</label>

                        <div class="col-md-6">
                            <select id="friends" type="text" class="form-control" name="friends" value="" required autofocus>
                              <option value="">Select Friends with</option>
                              <option value="Straight Male" @if($user->friends == 'Straight Male') {{ 'selected' }} @endif >Straight Male</option>
                              <option value="Gay Male" @if($user->friends == 'Gay Male') {{ 'selected' }} @endif >Gay Male</option>
                              <option value="Bi Male" @if($user->friends == 'Bi Male') {{ 'selected' }} @endif >Bi Male</option>
                              <option value="Straight Female" @if($user->friends == 'Straight Female') {{ 'selected' }} @endif >Straight Female</option>
                              <option value="Gay Female" @if($user->friends == 'Gay Female') {{ 'selected' }} @endif >Gay Female</option>
                              <option value="Bi Female" @if($user->friends == 'Bi Female') {{ 'selected' }} @endif >Bi Female</option>
                            </select>

                            @if ($errors->has('friends'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('friends') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-2">
                            <input type="submit" name="submit" class="btn btn-primary site-button" value="Save">
                            <a href="{{ url('/dashboard')}}" class="btn btn-primary site-button">
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

$('#userprofile').formValidation({
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
                   'activity[]': {
                    validators: {
                        choice: {
                            min: 1,
                            message: 'Please choose at least one activity'
                        }
                    }
                },
                "dob": {
                    validators: {
                        date: {
                            format: 'MM/DD/YYYY',
                            message: 'The value is not a valid date'
                        }
                    }
                },
                "phone" : {
                  validators: {
                        numeric: {
                            message: 'The value is not a number'
                        }
                    }
                },
            }
        })


        
 $("#profile_image").click(function(){
    $('input[name="profile_image"]').click();
 });

$("input[name='profile_image']").change(function(){
   var filename = $(this).val();
   var extension = filename.replace(/^.*\./, '');
   if(extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
        readURL(this);
   } else {
        alert('Please upload a valid image format e.g(jpg, jpeg, png)');
   }
});

$('.select-all').click(function() {
    if ($(this).is(':checked')) {
        $('.activities input[type="checkbox"]').attr('checked', true);
    } else {
        $('.activities input[type="checkbox"]').attr('checked', false);
    }
});

});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.profile_display').attr('src', e.target.result);
            $('.profile_display').css('width', '171px').css('height','171px');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection