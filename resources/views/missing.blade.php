@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row pages-content search-pages search-result">
		<div class="col-md-12 col-sm-12 top-options">
			<div id="missing_person">
				<form method="get" action="{{ url('/search-results') }}">
					<div class="col-sm-3">
						<input type="first_name" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
					</div>
					<div class="col-sm-3">
						<input type="last_name" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
					</div>
					<div class="col-sm-2">
						<button class="btn btn-primary" type="submit" id="search">Search</button>
					</div>
					<!-- <div class="col-sm-2">
            <button class="btn btn-primary"  id="search">Advance</button>
          </div> -->
				</form>
			</div>
		</div>

		<div class="bottom-area col-md-12" id="example">

			     @if(count(@$userData) > 0) 
                <div class="col-md-12 col-sm-12 top-options">
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
                   @foreach (@$userData as $value)
                     @if(@Auth::user()->id != $value->id)
                      <div class="block col-md-12">
                          <div class="col-md-2 col-sm-3 col-xs-6 image-section">
                              @if($value->profile_image == '') 
                                <a href="{{ url('/profile/'.$value->id) }}"><img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/></a>
                              @else 
                                <a href="{{ url('/profile/'.$value->id) }}"><img src="{{ asset('public/assets/images/users/'.$value->profile_image) }}"/></a>
                              @endif
                          </div>
                          <div class="col-md-10 col-sm-9 content-section">

                             <div class="col-md-4 profile-left">
                                <h4><a href="{{ url('/profile/'.$value->id) }}">{{ ucfirst($value->first_name)." ".ucfirst($value->last_name) }}</a></h4> 
                                <p>{{ ucfirst($value->gender) }}</p>
                                <?php 
                                $now  = Carbon\Carbon::now();
                                $end = Carbon\Carbon::parse($value->dob);
                                ?>
                                <p><?php echo $now->diffInYears($end); ?> yrs </p>
                                <p>{{ @$value->location[0]->location }} </p>
                                <p>{{ @$value->location[0]->address }} </p>
                            </div> 
                            <div class="col-md-8 profile-right">
                              <p><h3><b>More information about {{ ucfirst($value->first_name) }}</b></h3></p>
                              <p class="details1">
                                  {{ str_limit(ucfirst($value->about),200) }}
                              </p>
                              <p class="profile_view_button"> <a href="{{ url('/profile/'.$value->id) }}">Click here to view profile</a></p>
                            </div>
                              
                          </div>
                      </div>
                    @endif
                  @endforeach
                <div>{{ @$userData->appends(['first_name' => $_REQUEST['first_name'], 'last_name' => $_REQUEST['last_name']])->links() }}</div>
            @endif
    </div>
	</div>
</div>

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
      jQuery('.no-records').remove();

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
        var div = '<div class="col-md-12 no-records">No Records Found</div>';
        jQuery('#example').append(div);
      }
        
    });
  });
</script>
@endsection