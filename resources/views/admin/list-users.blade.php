@extends('layouts.layout_admin')
@section('title')
List Users
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')
<main id="app-main" class="app-main">
  <div class="wrap">
   <section class="app-content">
    <div class="ibp_dashboard_cont_inr">
      <div class="ibp_dashboard_cont">
       <a class="btn btn-success" id="addNewPAgeButton" href="{{ url('/admin/add_new_user') }}">Add new user</a>
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
        @if(!empty($data))
      @foreach($data as $value)
       <div class="col-md-5">
                  <div class="user-card">
                    <div class="media">
                      <div class="media-left">
                        <div class="avatar avatar-lg avatar-circle">
                          <a href="javascript:void(0)"><img src="@if(!empty($value->profile_image)){{ getUserImage($value->profile_image) }} @else{{ asset('public/assets/images/user.png') }}
                          @endif" alt=""></a>
                        </div>
                      </div>
                      <div class="media-body">
                        <h5 class="media-heading"><a href="javascript:void(0)" class="title-color">{{ $value->username}}</a></h5>
                         <h4 class="media-heading"><a href="javascript:void(0)" class="title-color">{{ $value->email}}</a></h4>
                        <small class="media-meta">{{ $value->first_name }}</small>
                      </div>
                    </div>
                    <div class="contact-item-actions edit-section">
                            <a href="{{ url('/admin/edit-user/'.base64_encode($value->id)) }}"  class="btn btn-success editProduct"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger delPro" id="{{ $value->id }}" data-toggle="modal" data-target="#deleteItemModal"><i class="fa fa-trash"></i></a>
                          </div><!-- .contact-item-actions -->
                  </div><!-- search-result -->
                </div><!-- END column -->

      @endforeach
      @endif
    </div>
  </div>
</section>
</div>
<!-- delete item Modal -->
<div id="deleteItemModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete item</h4>
      </div>
      <form method="Post" action="{{ url('/admin/delete-user') }}" >
        <div class="modal-body">
          <h5>Do you really want to delete this item ?</h5>
        </div><!-- .modal-body -->
        {{ csrf_field() }}
        <div class="modal-footer">
          <input type="hidden" name="user_id" value="" id="del_user_id">
          <button type="submit" class="btn btn-danger" >Delete</button>
        </form>
      </div><!-- .modal-footer -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</main>

@endsection
@section('css')
<style type="text/css">
	
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
#addNewPAgeButton{float: right;}
.alert{width: 35%;}
.edit-section a.btn {
    padding: 0px 10px !important;
}
.contact-item-actions.edit-section {
    display: block;
    opacity: 1;
}
</style>
<script type="text/javascript">

 $(document).ready(function() {
   $('.delPro').click(function(){
      var id=$(this).attr('id');
      $('#del_user_id').val(id);
  });
 });
</script>
@endsection