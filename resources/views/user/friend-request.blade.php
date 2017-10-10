@extends('layouts.app')

@section('content')
<div class="container-high">
  <div class="row">
    @include('layouts.dashboardsidebar')
    <div class="col-md-10 profile-area">
      <div class="friend-req">
        <div class="inner-white">
          <h3 class="friend-heading">Find friends <span class="inputt"><input class="text_box" type="text" id="find_frnd"></span></h3>
          <div class="main-block">
            <h3 class="main-heading">Friend Request</h3>
            @foreach ($frnd_rqst as $requests)
              <form method="post" action="{{ url('user/frnd_rqst') }}">
               {{ csrf_field() }}
               <input type="hidden" name="sender_id" value="{{ $requests->sender_id }}">
               <input type="hidden" name="receiver_id" value="{{ $requests->receiver_id }}">
               <div class="col-md-4 col-lg-3 col-sm-5 friend-block request">
                 @if($requests->getSendRequestUser->profile_image == '') 
                 <img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/>
                 @else 
                 <img src="{{ asset('public/assets/images/users/'.$requests->getSendRequestUser->profile_image) }}"/>
                 @endif
                 <p>{{ ucfirst($requests->getSendRequestUser->first_name)." ".ucfirst($requests->getSendRequestUser->last_name) }}</p>
                 <button name="accepted" value="accepted"  class="fa fa-check-circle" title="accept"></button>
                 <button name="rejected" value="rejected" class="fa fa-times-circle" title="reject"></button>
                 <!-- <i class="fa fa-times-circle" aria-hidden="true"></i><i class="fa fa-check-circle" aria-hidden="true"></i> -->
               </div>
             </form>
            @endforeach
            <div>{{ $frnd_rqst->links() }}</div>
          <!-- <div class="col-md-4 col-lg-3 col-sm-5 friend-block request">
              <img src="{{ asset('assets/images/2.jpg') }}"  /> <p>Friends Name</p><i class="fa fa-times-circle" aria-hidden="true"></i><i class="fa fa-check-circle" aria-hidden="true"></i>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-5 friend-block request">
              <img src="{{ asset('assets/images/1.jpg') }}"  /> <p>Friends Name</p><i class="fa fa-times-circle" aria-hidden="true"></i><i class="fa fa-check-circle" aria-hidden="true"></i>
            </div> -->
          </div>
          <div class="main-block" id="all_frnds">
            <h3 class="main-heading">All Friends</h3>
            @foreach ($frnd_list as $frnds)
            @if(Auth::user()->id != $frnds->id)
            <div class="col-md-4 col-lg-3 col-sm-5 friend-block all-one">
                @if($frnds->Account_activate == 'activate')
                  @if($frnds->profile_image == '') 
                  <img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/>
                  @else 
                  <img src="{{ asset('public/assets/images/users/'.$frnds->profile_image) }}"/>
                  @endif
                @else 
                  <img src="{{ asset('assets/images/default-user.png') }}"/>
                @endif  
              <p><a href="/profile/{{ $frnds->id }}">{{ ucfirst($frnds->first_name)." ".ucfirst($frnds->last_name) }}</a></p>
              <form method="post" action="{{ url('/user/message') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $frnds->id }}" name="user_id">
                <a href="javascript:void();" class="msg_redirect"><i class="fa fa-comment" aria-hidden="true"></i></a>
              </form>
            </div>
            @endif
            @endforeach
            <div class="clearfix"></div>
            @if(count($frnd_list) > 9)
            <div class="col-md-12 text-center">
              <button class="btn btn-default load_more">Load More</button>
            </div>
            @endif
          </div>
          <div class="main-block">
            <h3 class="main-heading">You May Know</h3>
            @foreach ($know_frnds as $know_frnd)
             @if($know_frnd->Account_activate == 'activate')
              <div class="col-md-4 col-lg-3 col-sm-5 friend-block you-may">
                 @if($know_frnd->profile_image == '') 
                 <img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/>
                 @else 
                 <img src="{{ asset('public/assets/images/users/'.$know_frnd->profile_image) }}"/>
                 @endif
                <p>{{ ucfirst($know_frnd->first_name)." ".ucfirst($know_frnd->last_name) }}</p>
                <a href="/profile/{{ $know_frnd->id }}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
              </div>
              @endif
            @endforeach
            <!-- <div class="col-md-4 col-lg-3 col-sm-5 friend-block you-may">
              <img src="{{ asset('assets/images/2.jpg') }}"  /> <p>Friends Name</p><i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-5 friend-block you-may">
              <img src="{{ asset('assets/images/1.jpg') }}"  /> <p>Friends Name</p><i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-5 friend-block you-may">
              <img src="{{ asset('assets/images/2.jpg') }}"  /> <p>Friends Name</p><i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-5 friend-block you-may">
              <img src="{{ asset('assets/images/1.jpg') }}"  /> <p>Friends Name</p><i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-5 friend-block you-may">
              <img src="{{ asset('assets/images/2.jpg') }}"  /> <p>Friends Name</p><i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  .all-one {
    display: none;
  }
</style>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#find_frnd').keyup(function() {
      jQuery('.no-records').remove();
      var name = jQuery(this).val();
      var uname = name.substr(0,1).toUpperCase()+name.substr(1);
      jQuery('.all-one').hide();
      jQuery('.all-one p:contains('+name+'),p:contains('+uname+')').closest('.all-one').show();
      if (!$('.all-one:visible').length) {
        var div = '<div class="no-records">No Records Found</div>';
        jQuery('#all_frnds').append(div);
      }
    });

    jQuery('.msg_redirect').click(function(){
      jQuery(this).closest('form').submit();
    });

    jQuery('.all-one:lt(9)').show();
    var total = jQuery("#all_frnds .all-one").length;
    var show = 9;
    jQuery('.load_more').click(function(e){
      e.preventDefault();
      show= (show+9 <= total) ? show+9 : total;
      jQuery('#all_frnds .all-one:lt('+show+')').show();

    });
  });
</script>
@endsection