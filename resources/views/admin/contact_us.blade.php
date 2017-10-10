@extends('layouts.layout_admin')
@section('title')
     Contact Us
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')

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
				<form id="ProductForm" action="{{ url('admin/contact_us') }}" method="Post" enctype="multipart/form-data">
        <input type="hidden" value="39.7747696750341" name="lat" id="latbox">
          <input type="hidden" value="-101.60156287500001" name="lng" id="lngbox">
				<div class="outr_box_shadow">
        {{csrf_field()}}
					<h2 class="h2_product"><span>Edit Contact Us</span></h2>
					<div style="margin-top:30px" class="box_shadow_inr col-md-12 col-xs-12 col-sm-12">
					<h4 class="h4_product">Select Your Office Location</h4>
          <h3>Drag & Drop Marker on Map</h3>
					<div class="form-group">
          <div class="mapDiv">
                <div id="map"></div>
          </div>

          <script>

                  // The following example creates a marker in Stockholm, Sweden using a DROP
                  // animation. Clicking on the marker will toggle the animation between a BOUNCE
                  // animation and no animation.

                  var marker;
                  var lati= <?php echo $record->lat ?>;
                  var lngi= <?php echo $record->lng ?>;
                  function initMap() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                      zoom: 6,
                      center: {lat: lati , lng: lngi}
                    });

                    marker = new google.maps.Marker({
                      map: map,
                      draggable: true,
                      animation: google.maps.Animation.DROP,
                      position: {lat: lati, lng: lngi}
                    });
                    marker.addListener('click', toggleBounce);

                    new google.maps.event.addListener(marker, 'drag', function(event){
                    document.getElementById("latbox").value = event.latLng.lat();
                    document.getElementById("lngbox").value = event.latLng.lng();
                  });
                  }

                  function toggleBounce() {
                    if (marker.getAnimation() !== null) {
                      marker.setAnimation(null);
                    } else {
                      marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                  }
                
                </script>
                <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeGs_jU8BIyGk6bAc79PDBdDYFG0E0cDs&callback=initMap">
               </script>
					</div>
					 <h4 class="h4_product">Contact No.</h4>
						<div class="form-group">
              <input type="text" value="<?= @($record->contact_number) ?>" name="contact_number" placeholder="Contact No." class="form-control">       
            </div>

             <h4 class="h4_product">Message</h4>
            <div class="form-group">
              <input type="text" value="<?= @($record->contact_email) ?>" name="contact_email" placeholder="Email" class="form-control">       
            </div>


             <h4 class="h4_product">Address</h4>
            <div class="form-group">
              <input type="text" value="<?= @($record->address) ?>" name="address" placeholder="Address" class="form-control">       
            </div>


					</div>
						
					<div class="marginBot col-md-12 col-xs-12 col-sm-12">
							<button type="submit" class="btn mw-md btn-primary pull-right">Submit</button>
					</div>
				</div>
				
			</form>

			</div>
			</div>
	</section>
  </div>
</main>

@endsection
@section('css')
<style type="text/css">
	 #map {
        height: 100%;
     }
.mapDiv
{
  height: 350px;
  width: 100%;
  margin-bottom: 25px;
}
.box_shadow_inr {
    background-color: #fff;
    border-radius: 3px;
    box-shadow: 3px 9px 9px 2px rgba(0, 0, 0, 0.1);
    margin: 2% 0;
    padding: 15px;
}
.outr_box_shadow {
    float: none;
    margin: 0 auto;
    max-width: 700px;
}
.h2_product {
    font-size: 22px;
    text-align: center;
}
.h2_product span {
    border-bottom: 3px solid #188ae2;
    line-height: 23px;
    padding-bottom: 10px;
}
h1, .h1, h2, .h2, h3, .h3 {
    margin-bottom: 10px;
    margin-top: 20px;
}
.ibp_dashboard_cont_inr {
    float: none;
    margin: 0 auto;
    max-width: 1200px;
    width: 100%;
}
.ibp_dashboard_cont {
    float: left;
    width: 100%;
}
h4, .h4
{
	font-size: 14px;
}
.hoverColor:hover
{
	background-color: #eee;
}
.table tr td select {
	width: 117px;
}
.table tr td select option {
	padding: 5px;
}
.marginBot
{
	margin-top: 30px;
	margin-bottom: 50px;
}
#map {
        height: 100%;
     }
.mapDiv
{
	height: 350px;
	width: 100%;
	margin-bottom: 25px;
}
.hoverColorChecked
{
	background-color: #eee;
}


.edit_serv_img {
    position: relative;
    text-align: center;
}
.padd_5 {
    padding: 5px;
}
.padd_left_right_all_zero {
    padding-left: 0;
    padding-right: 0;
}

.edit_serv_img .del_gal_img {
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
}
.del_gal_img img {
    position: relative;
    top: calc(50% - 10px);
}
.edit_serv_img:hover .del_gal_img {
    display: block;
}
.floatRight
{
	height:100px;width:100px;float:right;
}
</style>
@endsection
@section('script')
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
                 "contact_nunmber": 
                 {
                        validators: 
                        {
                            notEmpty: 
                            {
                                message: 'Field is required'
                            }
                        }
                    },
                "message": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  },
                  "address": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  },
            }
        })

	});
</script>

@endsection