@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pages-content search-pages search-result">
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
        <div class="bottom-area col-md-12">
        	<h3 class="main-heading">Search Result</h3>
                  @if(count($userData) > 0)
                   @foreach ($userData as $value)
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
                                $end = Carbon\Carbon::parse(date_format(date_create($value->dob),"d-m-Y"));
                                ?>
                                <p><?php echo $now->diffInYears($end); ?> yrs </p> 
                                <p> {{ @$value->location[0]->location }}</p>
                                <p> {{ @$value->location[0]->address }}</p>
                            </div>
                            <div class="col-md-8 profile-right">
                                <p><h3><b>More information about {{ ucfirst($value->first_name) }}</b></h3></p>
                                <p class="details1">
                                  {{ str_limit(ucfirst($value->about),250) }}
                                </p>
                                <p class="profile_view_button"> <a href="{{ url('/profile/'.$value->id) }}">Click here to view profile</a></p>
                            </div>

                          </div>
                      </div>
                      @endif
                    @endforeach
                    @else 
                      <div class="no-records">No Records Found</div>
                    @endif
                    <div class="pagination">
                      {{ $userData->appends(['day' => $_REQUEST['day'], 'month' => $_REQUEST['month'], 'year' => $_REQUEST['year']])->links() }}
                    </div>
               

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
        var div = '<div class="no-records">No Records Found</div>';
        jQuery('.main-heading').after(div);
      }
        
    });
  });
</script> 
@endsection
