@extends('layouts.app')

@section('content')
<div class="container-high">
  <div class="row">
    @include('layouts.dashboardsidebar')
    <div class="col-md-10 profile-area">
      <div class="photos-link">
        <div class="inner-white photo">
          <h3 class="form-heading"><i class="fa fa-camera fa-lg" aria-hidden="true"></i>Photos</h3>
          <div class="photos">
            @foreach ($photos as $value) 
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 photo-div">
              <div class="image">
                <span data-photosid="{{$value->id}}"><img src="{{ asset('public/assets/images/remove.png') }}" class="remove-icon"></span>
                <img src="{{ asset('public/assets/images/user_photos/'.$value->photos) }}">
              </div>
            </div>
            @endforeach
           <!--  <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 photo-div">
             <div class="image">
               <img src="{{ asset('assets/images/user1.jpg') }}">
             </div>
           </div>
           <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 photo-div">
             <div class="image">
               <img src="{{ asset('assets/images/user2.jpg') }}">
             </div>
           </div>
           <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 photo-div">
             <div class="image">
               single pic 
             </div>
           </div>
           <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 photo-div">
             <div class="image">
               single pic 
             </div>
           </div>
           <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 photo-div">
             <div class="image">
               single pic 
             </div>
           </div>
           <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 photo-div">
             <div class="image">
               single pic 
             </div>
           </div>
           <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 photo-div">
             <div class="image">
               single pic 
             </div>
           </div> -->
          </div>
          <div class="row">
            <button class="btn btn-primary site-button" data-toggle="modal" data-target="#myModal"> Upload Photo </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('/user/uploadPhotos') }}" id="image_form">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label col-sm-3" for="image">Select Photo:</label>
            <div class="col-sm-9">
              <input type="file"  id="image" name="image" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3">
              <button class="btn btn-primary site-button" id="upload_image">Upload</button>
            </div>
          </div>

        </form>
      </div>
      <!-- div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>

 <button class="btn btn-primary site-button" data-toggle="modal" data-target="#deletePhoto" id="deletePhotoBtn" style="display: none;"> Upload Photo </button>
<div id="deletePhoto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Photo</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure want to delete ?</p>
        <form method="post" action="{{ url('/user/deletePhotos') }}" style="padding: 10px;">
          {{ csrf_field() }}
          <input type="hidden" name="photo_id" id="photo_id">
          <button class="btn btn-primary" type="submit">Delete</button>
        </form>
      </div>
      <!-- div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery(".photo-div").hover(function(){
      $(this).find('span').show();
    },function(){
      jQuery(this).find('span').hide();
    });
    jQuery('.photo-div span').click(function(){
      var id = jQuery(this).data('photosid');
      jQuery('#photo_id').val(id);
      jQuery('#deletePhotoBtn').click();
    });
    jQuery('#upload_image').click(function(e) {
      var filename = jQuery('#image').val();
      var extension = filename.replace(/^.*\./, '');
      if(extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
        jQuery('#image_form').submit();
      } else {
        jQuery('#image').val('');
        alert('Please upload a valid image format e.g(jpg, jpeg, png)');

      }
    });

  });
</script>
@endsection