@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row pages-content search-pages search-result">
        <h3 class="main-heading">Search Result</h3>
		<div class="col-md-12 col-sm-12 top-options">
			<div id="map_wrapper">
				<div id="map_canvas" class="mapping"></div>
			</div>
		</div>

		<div class="bottom-area col-md-12" id="example">
            <div class="col-md-12 col-sm-12 top-options" style="display: none;">
                <div class="gender">
                    <span>Gender</span>
                    <select class="select_box" value="" id="gender">
                        <option>Select an option</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="gender">
                    <span>Age</span>
                    <select class="select_box" value="" id="age">

                    </select>
                </div>
            </div>
			@foreach($cafe as $value)
				<div class="zip_search" id="zip-{{ $value->id }}" style="display: none;"> 
					<h3><b>Cafe Members :</b></h3>
					@foreach($value->getCafeUser as $users)
						@if(@Auth::user()->id != $users->id)
							@if($users->Account_activate =='activate')
							<div class="block col-md-12">
								<div class="col-md-2 col-sm-3 col-xs-6 image-section">
									@if($users->profile_image == '') 
									<a href="{{ url('/profile/'.$users->id) }}"><img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/></a>
									@else 
									<a href="{{ url('/profile/'.$users->id) }}"><img src="{{ asset('public/assets/images/users/'.$users->profile_image) }}"/></a>
									@endif
								</div>
								<div class="col-md-10 col-sm-9 content-section">

                                    <div class="col-md-4 profile-left">
                                       <h4><a href="{{ url('/profile/'.$users->id) }}">{{ ucfirst($users->first_name)." ".ucfirst($users->last_name) }}</a></h4> 
                                       <p>{{ ucfirst($users->gender) }}</p>
                                       <?php 
                                       $now  = Carbon\Carbon::now();
                                       $end = Carbon\Carbon::parse($users->dob);
                                       ?>
                                       <p><?php echo $now->diffInYears($end); ?> yrs </p>
                                       <p>{{ @$users->location[0]->location }} </p>
                                       <p>{{ @$users->location[0]->address }} </p>
                                   </div>
                                   <div class="col-md-8 profile-right">
                                        <p><h3><b>More information about {{ ucfirst($users->first_name) }}</b></h3></p>
                                       <p class="details1">
                                          {{ str_limit(ucfirst($users->about),200) }}
                                      </p>
                                      <p class="profile_view_button"> <a href="{{ url('/profile/'.$users->id) }}">Click here to view profile</a></p>
                                  </div>

								</div>
							</div>
							@endif
						@endif
					@endforeach
                    <?php 
                       $count = count($value->getCafeUser)/10;
                    ?>
                    @if($count > 1) 
                    <div class="pagination">
                        <ul class="pagination custom_pagination">
                            <li class="next disabled"><a data-id="prev">«</a></li>
                            @for($i = 0; $i < round($count); $i++)
                             <li class="<?php if($i == 0 ) { echo 'active';} ?>"><a data-id="<?php echo 10*$i;?>" data-div="#zip-{{ $value->id }}" data-count="<?php echo round($count); ?>">{{ $i+1 }}</a></li>
                            @endfor
                            <li class="prev"><a data-id="next" rel="next">»</a></li>
                        </ul>
                    </div>
                    @endif
				</div>
			@endforeach
		</div>

		<div class="col-md-12 no-records" style="display: none;">No Record Found</div>

	</div>
</div>
<style type="text/css">
	#map_wrapper {
		height: 400px;
	}

	#map_canvas {
		width: 100%;
		height: 100%;
	}
	.info_contetn p {
		cursor: pointer;
		color: #2167F1;
	}
    .block.col-md-12 {
        display: none;
    }
</style>
<script type="text/javascript">
	jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "//maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

    var data = {!! $cafe !!};
    var user_id = '{{ @Auth::user()->id }}';
    if(data.length == 0) {
    	jQuery('.no-records').show();
		jQuery('.top-options').hide();
    }

	function initialize() {
		var map;
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
			mapTypeId: 'roadmap'
		};

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);

    // Multiple Markers
    /* make marker*/
    var myArray = new Array();
    data.forEach(function(item,index) {
    	
    	myArray[index] = new Array();
    	myArray[index]['store_name'] = item.Store_Name;
    	myArray[index]['lat'] = item.Latitude;
    	myArray[index]['lng'] = item.Longitude;
    	var count = 0;
    	item.get_cafe_user.forEach(function(value,index2){
    		if(user_id != value.id) {
    			if(value.Account_activate == 'activate') {
    				count++;
    			}
    		}
    	});
    	var marker_info = '<div class="info_contetn"><h3>'+item.Store_Name+'</h3><p id="'+item.id+'" title="click here to view members"><b>Total Members</b> : '+count+'</p></div>';
    	myArray[index]['info'] = marker_info;

    });
    /* make marker*/
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < myArray.length; i++ ) {
    	var position = new google.maps.LatLng(myArray[i]['lat'], myArray[i]['lng']);
    	bounds.extend(position);
    	marker = new google.maps.Marker({
    		position: position,
    		map: map,
    		title: myArray[i]['store_name']
    	});

        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
        	return function() {
        		infoWindow.setContent(myArray[i]['info']);
        		infoWindow.open(map, marker);
        	}
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
    	this.setZoom(14);
    	google.maps.event.removeListener(boundsListener);
    });
    
    jQuery('body').on('click','.info_contetn p',function(){
    	var id = jQuery(this).attr('id');
    	jQuery('.zip_search').hide();
    	jQuery('#zip-'+id).show();
        jQuery('.top-options').show();
        jQuery('#zip-'+id+' .block.col-md-12:lt(10)').show();
    	infoWindow.close();
    });
}


</script>
<script type="text/javascript">
  var option = '<option>Select an age</option>';
  for(var i = 18; i <= 60; i++) {
    option+= '<option>'+i+'</option>';
  }
  document.getElementById('age').innerHTML = option;

  jQuery(document).ready(function(){
    jQuery('.select_box').change(function(){
      var gender = jQuery('#gender').val();
      var age = jQuery('#age').val();
      jQuery('.bottom-area .block').hide();
      jQuery('.no-records').hide();

      if(gender == 'Select an option' && age == 'Select an age') {
        jQuery('.bottom-area .block').show();
      } else if( gender != 'Select an option' && age == 'Select an age') {
        jQuery('.bottom-area .block p:contains('+gender+')').closest('.block').show();
      } else if(gender == 'Select an option' && age != 'Select an age') {
        jQuery('.bottom-area .block p:contains('+age+')').closest('.block').show();
      } else {
        var a = 0;
        jQuery('.block').each(function() {
          if(jQuery(this).find('p:contains('+age+')').length > 0 && jQuery(this).find('p:contains('+gender+')').length > 0) {
            jQuery(this).show();
          } 
        });
      }

      if (!$('.block:visible').length) {
        jQuery('.no-records').show();
      }
        
    });

    jQuery('.custom_pagination li a').click(function(){
        var gt = jQuery(this).data('id')-1;
        var lt = gt+10;
        var divId = jQuery(this).data('div');
        var curr_page = jQuery(this).text();
        var Total_page = jQuery(this).data('count');

        if(jQuery(this).data('id') == 'prev') {
           gt = jQuery(this).parent().siblings('.active').prev().children().data('id')-1;
           lt = gt+10;
           divId = jQuery(this).parent().siblings('.active').prev().children().data('div');
           curr_page = jQuery(this).parent().siblings('.active').prev().children().text();
           Total_page = jQuery(this).parent().siblings('.active').prev().children().data('count');
           jQuery('.custom_pagination li').removeClass('active');
           jQuery('.custom_pagination li:contains('+curr_page+')').addClass('active');
           //jQuery(this).parent().siblings('.active').prev().addClass('active');
        } else if( jQuery(this).data('id') == 'next'){
            gt = jQuery(this).parent().siblings('.active').next().children().data('id')-1;
            lt = gt+10;
            divId = jQuery(this).parent().siblings('.active').next().children().data('div');
            curr_page = jQuery(this).parent().siblings('.active').next().children().text();
            Total_page = jQuery(this).parent().siblings('.active').next().children().data('count');
            jQuery('.custom_pagination li').removeClass('active');
            jQuery('.custom_pagination li:contains('+curr_page+')').addClass('active');
            //jQuery(this).parent().siblings('.active').next().addClass('active');
        } else {
            jQuery('.custom_pagination li').removeClass('active');
            jQuery(this).parent().addClass('active');    
        }

        if(curr_page == Total_page) {
            jQuery('.custom_pagination li').removeClass('disabled');
            jQuery('.custom_pagination li.prev').addClass('disabled');
        } else {
           jQuery('.custom_pagination li').removeClass('disabled');
           jQuery('.custom_pagination li.next').addClass('disabled');
        }

        jQuery(divId+' .block.col-md-12').hide();
        if(gt < 0) {
            jQuery(divId+' .block.col-md-12:lt(10)').show();
        } else {
            alert(divId+' .block.col-md-12:gt('+gt+'):lt('+lt+')');
            jQuery(divId+' .block.col-md-12:gt('+gt+'):lt('+lt+')').show();
        }

        
    });

  });
</script>
@endsection
