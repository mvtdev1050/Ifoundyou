@extends('layouts.app')

@section('content')
<div class="container" id="profile_details">
    <div class="row pages-content search-pages">
        <h3 class="main-heading text-center">{{ ucfirst($user->first_name)."'s Profile" }}</h3>
        <div class="col-md-3 col-sm-3 profile_pic">
        	@if($user->profile_image == '') 
            <img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/>
          @else 
            <img src="{{ asset('public/assets/images/users/'.$user->profile_image) }}"/>
          @endif
          <form method="post" action="{{ url('/send-request') }}">
              @if($user->id != @Auth::user()->id)
                  @if (Auth::check())
                     {{ csrf_field() }}
                     <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                     @if(@$sent_request == 'yes')
                     <div class="btn-group">
                      <span type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Friend Request Sent&nbsp;&nbsp;&nbsp; <span class="caret"></span></span>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#" data-toggle="modal" data-target="#cancelModal">Cancel Request</a></li>
                        </ul>
                      </div>
                     @elseif(@$pending_request == 'yes')
                       <div class="btn-group">
                        <span type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Request Pending&nbsp;&nbsp;&nbsp; <span class="caret"></span></span>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#" data-toggle="modal" data-target="#cancelModal">Cancel Request</a></li>
                        </ul>
                      </div>
                    @elseif(@$friend == 'yes')
                        <a href="#" data-toggle="modal" data-target="#cancelModal" class="btn btn-default">Unfriend</a>
                     @else 
                       <button class="btn btn-default" name="send_request" type="submit" value="send_request">Send Request</button>
                       @if(@$bookmark == 'yes')
                       <button class="btn btn-default" name="unbookmark" type="submit" value="unbookmark">UnBookmark</button>
                       @else
                        <button class="btn btn-default" name="bookmark" type="submit" value="bookmark">Bookmark</button>
                       @endif
                     @endif 
                  @else 
                  <a class="btn btn-default" data-toggle="modal" data-target="#myModal">Send Request</a>
                  <a class="btn btn-default" data-toggle="modal" data-target="#myModal">Bookmark</a>
                @endif
            @endif  
          </form>
        </div>

        <div class="col-md-9 col-sm-9 col-xs-12 user_details">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#info">About</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#friends">Friends</a></li>
          </ul>
          <!-- tab conetnt-->
          <div class="tab-content">
             <!-- info content-->
            <div id="info" class="tab-pane fade in active">
            	<div class="col-md-12 padding-none" id="general-info">
	                <div class="col-md-4">
	                    <h3 class="main-heading">Identity</h3>

	                    <div class="name top-margin">
	                        <div class="col-md-5">Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</div>
	                        <div class="col-md-7">{{ ucfirst($user->first_name)." ".ucfirst($user->last_name) }}</div>
	                    </div>

	                    <div class="gender top-margin">
	                        <div class="col-md-5">Gender &nbsp;&nbsp;&nbsp;&nbsp; :</div>
	                        <div class="col-md-7">{{ ucfirst($user->gender) }}</div>
	                    </div>

	                    <div class="age top-margin">
	                        <div class="col-md-5">Age &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; :</div>
	                        <div class="col-md-7">
	                            <?php 
	                            $now  = Carbon\Carbon::now();
	                            $end = Carbon\Carbon::parse($user->dob);
	                            echo $now->diffInYears($end)." years old";
	                            ?>
	                        </div>
	                    </div>
	                    <div class="locations top-margin">
	                        <div class="col-md-5">Location &nbsp;&nbsp; :</div>
	                        <div class="col-md-7">{{ @$user->location[0]->location }}</div>
	                    </div>

	                    <div class="address top-margin">
	                        <div class="col-md-5">Address &nbsp;&nbsp;&nbsp;&nbsp; :</div>
	                        <div class="col-md-7">{{ @$user->location[0]->address }}</div>
	                    </div>
	                </div>

	                <div class="col-md-4">
	                    <h3 class="main-heading">Looks</h3>
	                    <div class="height top-margin">
	                        <div class="col-md-5">Height &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</div>
	                        <div class="col-md-7">{{ @$user->height }}</div>
	                    </div>

	                    <div class="eyes top-margin">
	                        <div class="col-md-5">Eyes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</div>
	                        <div class="col-md-7">{{ @$user->eye_color }}</div>
	                    </div>

	                    <div class="hair top-margin">
	                        <div class="col-md-5">Hair &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</div>
	                        <div class="col-md-7">{{ @$user->hair_color }}</div>
	                    </div>

	                    <div class="body-type top-margin">
	                        <div class="col-md-5">Body type :</div>
	                        <div class="col-md-7">{{ @$user->body_type }}</div>
	                    </div>

	                    <div class="ethnicity top-margin">
	                        <div class="col-md-5">Ethnicity &nbsp;&nbsp; :</div>
	                        <div class="col-md-7">{{ @$user->ethnicity }}</div>
	                    </div>

	                </div>

	                <div class="col-md-4">
	                    <h3 class="main-heading">More Info</h3>
	                    <div class="friends-with top-margin">
	                        <div class="col-md-6">Friends with :</div>
	                        <div class="col-md-6">{{ @$user->friends }}</div>
	                    </div>
	                </div>
	            </div>
	            
	            <div class="col-md-12" id="contact-info">  
	            	<h3 class="main-heading" >Contact</h3>
                <div class="col-md-6 email">
                  <div class="col-md-4">Email &nbsp;&nbsp;&nbsp; :</div>
                  @if(@Auth::user()->id == @$user->id)
                    <div class="col-md-8">{{ $user->email }}</div>
                  @elseif(@$friend == 'yes')
                       @if(@$privacy->email_privacy == 'Friends' || @$privacy->email_privacy == 'Public' || @$privacy->email_privacy == '')
                          <div class="col-md-8">{{ $user->email }}</div>
                      @endif
                  @else 
                      <button class="btn btn-success">Join</button>    
                  @endif 
                </div>
                <div class="col-md-6 phone">
                  <div class="col-md-4">Phone &nbsp;&nbsp;&nbsp; :</div>
                  @if(@Auth::user()->id == @$user->id)
                  <div class="col-md-8">{{ $user->phone }}</div>
                  @elseif(@$friend == 'yes')
                  @if(@$privacy->phone_privacy == 'Friends' || @$privacy->phone_privacy == 'Public' || @$privacy->phone_privacy == '')
                  <div class="col-md-8">{{ $user->phone }}</div>
                  @endif
                  @else 
                  <button class="btn btn-success">Join</button>    
                  @endif 
                <!-- @if(@$privacy->phone_privacy == 'Friends' && @$friend == 'yes' || @$privacy->phone_privacy == 'Public' || @$privacy->phone_privacy == '')
                                  <div class="col-md-8">{{ $user->phone }}</div>
                 @endif -->
                </div>
	            </div> 

	            <div class="col-md-12" id="activities-info">  
	            	<h3 class="main-heading">Activities I'm available for</h3>
	            	<p><?php echo str_replace('all, ', '', $user->activity) ?></p>
	            </div> 

	            <div class="col-md-12" id="about-info">  
	            	<h3 class="main-heading">More info about {{ ucfirst($user->first_name) }}</h3>
	            	<p>{{ $user->about }}</p>
	            </div>  
            </div>
             <!--end info content-->
             <!-- photos content-->
            <div id="photos" class="tab-pane fade">
              	<div class="col-md-12 popup-gallery" id="user-photos">
                @if(@$privacy->photos_privacy == 'Friends' && @$friend == 'yes' && count($user_photo) > 0 || @$privacy->photos_privacy == 'Public' && count($user_photo) > 0 || @$privacy->photos_privacy == '' && count($user_photo) > 0 )
              	 	@foreach($user_photo as $photo)
              			<a href="{{ asset('public/assets/images/user_large_photos/'.$photo->photos) }}" title="{{ $photo->photos }}" class="col-md-3 padding-none">
              				<img src="{{ asset('public/assets/images/user_photos/'.$photo->photos) }}">
              			</a>
              		@endforeach
                @else  
                  <div class="text-center">No photos to show</div>
                @endif   
              	</div>
              	@if(count($user_photo) > 16)
              	<div class="col-md-12 text-center"><button class="btn btn-default" id="load_more_pics">Load More</button></div>
              	@endif
            </div>
            <!-- end photos content-->
            <!-- friends content-->
            <div id="friends" class="tab-pane fade">
              	<div class="col-md-12" id="user-friends">
                 @if(@$privacy->friends_privacy == 'Friends' && @$friend == 'yes' && count($friends) > 0 || @$privacy->friends_privacy == 'Public' && count($friends) > 0 || @$privacy->friends_privacy == '' && count($friends) > 0)
              		@foreach($friends as $friend)
              			<div class="col-md-3 user-frnd-list">
              				@if($friend->sender_id == $user->id)
              					@if(@$friend->getApprovedFriends->Account_activate == 'activate')
              					<a href="{{ url('/profile/'.$friend->receiver_id) }}"> 
	              					@if($friend->getApprovedFriends->profile_image == '') 
	              					<img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/>
	              					@else 
	              					<img src="{{ asset('public/assets/images/users/'.$friend->getApprovedFriends->profile_image) }}"/>
	              					@endif
	              					 <div class="user-profile-name">{{ ucfirst($friend->getApprovedFriends->first_name)." ".ucfirst($friend->getApprovedFriends->last_name) }}</div>
              					</a>
              					@endif
              				@else
              					@if(@$friend->getSendRequestUser->Account_activate == 'activate')
              					<a href="{{ url('/profile/'.$friend->sender_id) }}"> 
	              					@if($friend->getSendRequestUser->profile_image == '') 
	              					<img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/>
	              					@else 
	              					<img src="{{ asset('public/assets/images/users/'.$friend->getSendRequestUser->profile_image) }}"/>
	              					@endif
	              					 <div class="user-profile-name">{{ ucfirst($friend->getSendRequestUser->first_name)." ".ucfirst($friend->getSendRequestUser->last_name) }}</div>
	              				</a>	 
              					@endif
              				@endif
              			</div>
              		@endforeach 
                 @else  
                 <div class="text-center">No friends to show</div>
                @endif
              	</div>
              	@if(count($friends) > 16)
              	<div class="col-md-12 text-center"><button class="btn btn-default" id="load_more_frnds">Load More</button></div>
              	@endif
            </div>
            <!-- end friends content-->
          </div>
          <!-- end tab conetnt-->
        </div>

    </div>
</div>

<!--cancel Request -->
<div id="cancelModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Friend Request</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure want to cancel friend request?</p>
        <form method="post" action="{{ url('/cancel-request') }}" style="padding: 5px;">
            {{ csrf_field() }}
            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
            <button class="btn btn-primary" name="cancel_request" type="submit" value="cancel_request">Cancel Request</button>
            <button class="btn btn-default" data-dismiss="modal"">Cancel</button>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
<!--cancel Request -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please login before sending request or bookmark</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="Login_form" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-3 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input type="hidden" name="search_details_id" value="{{ $user->id }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-3 control-label">Password</label>

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
                    <a class="btn btn-primary site-button"  data-dismiss="modal">Cancel </a>
                </div>
            </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
<style type="text/css">
	#user-photos a, #user-friends .user-frnd-list {
		display: none;
	}
</style>
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
<script type="text/javascript">
	$(document).ready(function() {
		$('.popup-gallery').magnificPopup({
			delegate: 'a',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title') + '<small>by {{ ucfirst($user->first_name) }}</small>';
			}
		}
	});
	});
</script>    
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#user-photos a:lt(16)').show();
		jQuery('#user-friends .user-frnd-list:lt(16)').show();

		function showContentMore(divId, clickBtn) {
			var show = 16;
			var total = jQuery(divId).length;
			show = (show +16 <= total) ? show +16: total;
			jQuery(divId+':lt('+show +')').show();
			if (jQuery(divId+':visible').length == total) {
				jQuery(clickBtn).hide();
			}
		}
		jQuery('#load_more_pics').click(function(e){
			e.preventDefault();
			showContentMore('#user-photos a','#load_more_pics');
		});
		jQuery('#load_more_frnds').click(function(e){
			e.preventDefault();
			showContentMore('#user-friends .user-frnd-list', '#load_more_frnds');
		});
	});
</script>
@endsection
