@extends('layouts.app')

@section('content')
<div class="container-high">
<?php //echo "<pre>";  print_r($data); echo "</pre>"; die;    ?>
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
        <div class="alert {{ $class }} col-md-10" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <span>{{ Session::get('custom_message') }}</span>
        </div>
        @endif
        <div class="col-md-10 profile-area">
                <div class="location">
                  <div class="inner-white">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/save_location') }}">
                      {{ csrf_field() }}
                      <input type="hidden" name="uid" value="{{ Auth::user()->id }}">
                      <h3 class="form-heading"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>Location</h3>

                      <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                          <label for="location" class="col-md-2 control-label fix-width-col-2">Location</label>

                          <div class="col-md-6" id="locationField">
                              <input id="autocomplete" type="text" class="form-control" name="location"  value="{{ @$data->location}}" required onFocus="geolocate()" maxlength="25">

                              @if ($errors->has('location'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('location') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                          <label for="address" class="col-md-2 control-label fix-width-col-2">Address</label>

                          <div class="col-md-6">
                              <input id="address" type="text" class="form-control" name="address" value="{{ @$data->address }}" required maxlength="50">

                              @if ($errors->has('address'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('address') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-2">
                            <button type="submit" class="btn btn-primary site-button">
                                Save
                            </button> 
                        </div>
                    </div>

                     </form>
                  </div>
              </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var placeSearch, autocomplete;

  function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});
        //autocomplete.addListener('place_changed', fillInAddress);
      }
      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPlNa9zC8a-Kez5fxHAnahdM815uw-tUw&libraries=places&callback=initAutocomplete"
        async defer></script>
@endsection

