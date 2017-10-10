@extends('layouts.app')

@section('content')
<div class="container-high">
  <div class="row">
    @include('layouts.dashboardsidebar')
    <div class="col-md-10 profile-area">
      <div class="location message-page">
        <div class="inner-white">
          <h3 class="form-heading"><i class="fa fa-envelope" aria-hidden="true"></i>Message</h3>
          <div class="message-blocks">

            <div class="message_list">
              <ul>
                    <?php $i = 0 ;?>
                @foreach ($frnd_list as $index => $value)
                 @if(Auth::user()->id != $value->id)
                    @if(@$chat_user)
                        @if($chat_user == $value->id)
                          <?php $class = 'active'; ?>
                        @else   
                          <?php $class = ''; ?>
                        @endif
                    @else
                      @if($i == 0)
                          <?php $class = 'active'; ?>
                        @else
                        <?php $class = ''; ?>
                      @endif
                    @endif
                   <li class="{{ $class }}" data-userid="{{ $value->id }}">
                      @if($value->Account_activate == 'activate')
                         @if($value->profile_image == '') 
                         <img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/>
                         @else 
                         <img src="{{ asset('public/assets/images/users/'.$value->profile_image) }}"/>
                         @endif 
                      @else 
                        <img src="{{ asset('assets/images/default-user.png') }}"/>
                      @endif 
                     <p>{{ ucfirst($value->first_name)." ".ucfirst($value->last_name) }}</p>
                   </li>
                   <?php $i++; ?>
                @endif
                @endforeach
              </ul>
            </div>
            @if(@$first_userid) 
            <div class="message_box">
              <img src="{{ asset('assets/images/loader.gif') }}" width="100%" style="display: none; position: absolute;" id="chat_loader">
              <img src="{{ asset('assets/images/msg_loader.gif') }}" width="100%" id="msg_loader">
              <div class="box1" id="chatbox_msg"> 
                {!! $chat_history !!}
              </div>

              <div class="box2">
                  <input type="hidden" id="token" value="{{ csrf_token() }}" >
                  <input type="hidden" value="{{ @$first_userid }}" id="receiver_id">
                </form>
                <textarea type="text" class="text_box"></textarea> <input class="send_button" type="button" value="Send">
              </div>
            </div>
        	@endif

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {
  	
  	updateScroll();	

    //if user at top of chat_box get prev msgs
    jQuery('#chatbox_msg').scroll(function() {
      var data = jQuery('#chatbox_msg').html();
      if(data != '') {
      	var pos = jQuery('#chatbox_msg').scrollTop();
        ChangeMsgStatus();
      	if (pos == 0) {
      		var user_id = jQuery('#receiver_id').val();
      		var token = jQuery('#token').val();
          var last_id =  jQuery('.user_chat:eq(0)').attr('id');

          jQuery('#msg_loader').show();
      		jQuery.ajax({
      			url    : "{{ url('/user/getPreviousChat') }}",
      			method : "POST",
      			data   : { receiver_id : user_id, _token: token, last_id: last_id },
      			success:function(resp){
              jQuery('#msg_loader').fadeOut(500);
              if(resp != '') {
                jQuery('#chatbox_msg').prepend(resp);
                jQuery('#chatbox_msg').scrollTop(30);
                var text = '';
                jQuery('.chat_day').each(function(){
                  if(text != jQuery(this).text() || text == '') {
                    text = jQuery(this).text();
                  } else {
                    jQuery(this).remove();
                  }
                });
              } else {
                jQuery('#chatbox_msg').scrollTop();
              }
      			}
      		});
      	}
      }
    });

    //when choose user for chat
    jQuery('.message_list li').click(function() {
      var old_user_id = jQuery('#receiver_id').val();
      var user_id = jQuery(this).data('userid');
      if(user_id != old_user_id) {
        jQuery('#receiver_id').val(user_id);
        jQuery('.message_list li').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('#chat_loader').show();
        jQuery('#msg_loader').hide();
        var token = jQuery('#token').val();

        jQuery('.message_box .box1').html('');
        jQuery.ajax({
          url    : "{{ url('/user/getUserChat') }}",
          method : "POST",
          data   : { receiver_id : user_id, _token: token },
          success:function(resp){
            jQuery('#chat_loader').hide();
            jQuery('.message_box .box1').html(resp);
            updateScroll(); 
          }
        });
      }
    });

    //when msg is send
    jQuery('.send_button').click(function(e) {
      e.preventDefault();
      var token = jQuery('#token').val();
      var msg = jQuery('.text_box').val().trim();
      var user_id = jQuery('#receiver_id').val();
      jQuery('.text_box').val('');
      if(msg != '') {
        jQuery.ajax({
          url    : "{{ url('/user/sendMessage') }}",
          method : "POST",
          data   : { receiver_id : user_id, message : msg, _token: token },
          success:function(resp){
            jQuery('.message_box .box1').html(resp);
            updateScroll();
          }
        });
      }
    });

    //when user click on input box then change status of msgs to read
    jQuery('.text_box').click(function() {
      ChangeMsgStatus();
    });

    function ChangeMsgStatus () {
      var token = jQuery('#token').val();
      var user_id = jQuery('#receiver_id').val();
      jQuery.ajax({
       url    : "{{ url('/user/changeMsgStatus') }}",
       method : "POST",
       data   : { receiver_id : user_id, _token: token },
       success:function(resp){
            //jQuery('.message_box img').hide();
            //jQuery('.message_box .box1').html(resp);
          }
        });
    }

    //when any msg is received.
    function getRealTImeChat() {
      var token = jQuery('#token').val();
      var user_id = jQuery('#receiver_id').val();
      var last_id =  jQuery('.user_chat:eq(0)').attr('id');
      jQuery.ajax({
      	url    : "{{ url('/user/getRealTImeChat') }}",
      	method : "POST",
      	data   : { receiver_id : user_id, _token: token, last_id: last_id },
      	success:function(resp){
      		var curr_user_id = jQuery('#receiver_id').val();
      		var data = resp.split('[:::]');
          //if curr select user for chat and user from return data is same then change html of chat
      		if(curr_user_id == data[1]) {
	      		jQuery('.message_box .box1').html(data[0]);
	      		updateScroll();
      		} 
      	}
      });
    }
  	setInterval(getRealTImeChat, 1000);

    //to stay on latest msg of chat
    function updateScroll(){
      var element = document.getElementById("chatbox_msg");
          if(element.scrollTop == 10 ){ 
            element.scrollTop = 10;
          }
          else {
            element.scrollTop = element.scrollHeight;  
          }
      }
    
  });
</script>
@endsection