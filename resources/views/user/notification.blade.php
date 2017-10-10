@extends('layouts.app')

@section('content')
<div class="container-high">
    <div class="row">
        @include('layouts.dashboardsidebar')
        <div class="col-md-10 profile-area noti"> 
            <div class="location">
                  <div class="inner-white">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/notificationStatus') }}" id="notification_form">
                      {{ csrf_field() }}

                      <h3 class="form-heading"><i class="fa fa-bell fa-lg" aria-hidden="true"></i>Notifications</h3>

                          <div class="notification_box">
                           <ul>

                            <li>
                              <input class="all_check_box" type="checkbox" />
                              <p class="select_all">Select all</p> 
                              <p class="mark_as_read">
                                <select name="status">
                                  <option>Select an option</option>
                                  <option value="read">Mark As Read</option>
                                  <option value="hide">Delete</option>
                                </select>
                              </p>
                            </li>
                            @foreach ($data as $notify) 
                              @if($notify->status == 'unread') 
                                <?php $class = 'unread_msg'; ?>
                              @else 
                              <?php $class = ''; ?>
                              @endif
                              @if($notify->status != 'hide')
                              <li class={{ $class }}>
                                <input class="check_box" type="checkbox" value="{{ $notify->id }}" name="notify[]"/> 
                                @if($notify->action == 'send_request')
                                {{ 'A friend request is sent by '.$notify->getUser->username }}
                                @elseif($notify->action == 'bookmark') 
                                {{ $notify->getUser->username.' has bookmarked you.' }}
                                @else 
                                {{ $notify->getUser->username.' has accepted your friend request.' }}  
                                @endif
                              </li>
                              @endif
                            @endforeach
                          </ul>
                          <div>{{ $data->links() }}</div>
                        </div>

                     </form>
                  </div>
              </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('.all_check_box').click(function(){
      jQuery('.check_box').click();
    });
    jQuery('select').change(function(){
      if(jQuery(this).val() != 'Select an option') {
        jQuery('#notification_form').submit();
      }
    });
  });
</script>
@endsection