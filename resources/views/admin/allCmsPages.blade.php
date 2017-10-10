@extends('layouts.layout_admin')
@section('title')
All cms pages
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')
<main id="app-main" class="app-main">
  <div class="wrap">
   <section class="app-content">
    <div class="">
      <div class="">
       <a class="btn btn-success" id="addNewPAgeButton" href="{{ url('/admin/add_new_page') }}">Add new page</a>
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
        <div class="col-md-1"></div>
        <div class="col-md-9">
          <div class="widget">
            <header class="widget-header">
              <h4 class="widget-title">Pages</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body"> 
              <div class="table-responsive">
                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                  <thead >
                    <tr>
                      <th style="text-align:center;width: 10%">Sr. No.</th>
                      <th style="text-align:center;width: 16%">Name</th>
                      <th style="text-align:center;width: 26%">Email</th>
                      <th style="text-align:center;">Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($data)){
                      $i=1;
                      foreach($data as $value){
                       ?>
                       <tr style="text-align:center">
                        <td><?= $i ?></td>
                        <td><?= $value->title ?></td>
                        <td><?= $value->slug ?></td>
                        <td><a href="{{ url('/admin/editCmsPage/'.$value->id )}}" class="btn btn-success" id="editBlogButton">Edit</a> <button class="btn btn-danger" id=deleteBlogButton onclick="openDelete('{{$value->id}}'); ">Delete</button></td>
                      </tr>
                      <?php $i++; }} ?>
                    </tbody>
                  </table>
                </div>
              </div><!-- .widget-body -->
            </div><!-- .widget -->
          </div><!-- END column -->
          <div class="col-md-2"></div>

       
    </div>
  </div>
</section>
</div>
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
</style>
@endsection
@section('script')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
  tinymce.init({ selector:'.box_shadow_inr textarea' });
</script>
<script type="text/javascript">
 function openDelete(id)
 {
   var confirmDel = confirm('Do you want to delete this ?');
   if(confirmDel == true ){
     location.href="{{ url('/admin/delete-cms-page') }}/"+ id;
   }
 }
</script>
@endsection