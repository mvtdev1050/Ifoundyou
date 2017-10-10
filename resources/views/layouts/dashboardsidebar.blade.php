<div class="col-md-2 sidebar navbar navbar-default">
	<div class="navbar-header">
		<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
		<a class="navbar-brand">Profile Menu</a>
	</div>
	<ul id="menu-content" class="collapse navbar-collapse">
		<li class="{{ @$profile_class }}"><a href="{{ url('/dashboard') }}" ><i class="fa fa-user" aria-hidden="true"></i></i>Profile</a></li>
		<li class="{{ @$frnd_class }}"><a href="{{ url('/user/friends') }}" ><i class="fa fa-heart" aria-hidden="true"></i></i>Friends<span class="msg_no frnd_notify" style="display: none;"></span></a></li>
		<li class="{{ @$photo_class }}"><a href="{{ url('/user/photos') }}" ><i class="fa fa-camera" aria-hidden="true"></i>Photos</a></li>
		<li class="{{ @$message_class }}"><a href="{{ url('/user/message') }}" ><i class="fa fa-envelope" aria-hidden="true"></i>Messages <span class="msg_no msg_notify" style="display: none;"></span></i></li></a></li>
		<li class="{{ @$notify_class }}"><a href="{{ url('/user/notification') }}" ><i class="fa fa-bell" aria-hidden="true"></i>Notification  <span class="msg_no notify" style="display: none;"></span></a></li>
		<li class="{{ @$subs_class }}"><a href="{{ url('/user/subscription') }}" ><i class="fa fa-plus-square-o" aria-hidden="true"></i>Subscription</a></li>
		<li class="{{ @$privacy_class }}"><a href="{{ url('/user/privacy') }}" ><i class="fa fa-cog" aria-hidden="true"></i>Privacy</a></li>
		<li class="{{ @$location_class }}"><a href="{{ url('/user/location') }}" ><i class="fa fa-map-marker" aria-hidden="true"></i>Location</a></li>
		<li class="{{ @$bookmark_class }}"><a href="{{ url('/user/bookmark') }}" ><i class="fa fa-star" aria-hidden="true"></i>Bookmarks<span class="msg_no bookmark_notify" style="display: none;"></span></a></li>
		<li class="{{ @$setting_class }}"><a href="{{ url('/user/settings') }}" ><i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>
	</ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){	
	var width = jQuery(window).width();
	var sidebar_height = jQuery('.container-high > .row .col-md-10').height();
	var assc = parseInt(sidebar_height);
	var assc1 = assc + 51;
	if(width>992){
		jQuery('.col-md-2.sidebar').css('height',assc1);
	}
});
</script>