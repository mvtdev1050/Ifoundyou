@extends('layouts.layout_admin')
@section('title')
     Edit Syep
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
				<form id="ProductForm" action="{{ url('admin/how_it_works/edit') }}" method="Post" enctype="multipart/form-data">
				<div class="outr_box_shadow">
					<h2 class="h2_product"><span>Edit Step</span></h2>
					<div style="margin-top:30px" class="box_shadow_inr col-md-12 col-xs-12 col-sm-12">
					<h4 class="h4_product">Title</h4>
						<div class="form-group">
							<input placeholder="Name" value="<?= @($record->title) ?>" name="title" class="form-control" type="text">
							 <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token" >
							 <input type="hidden" value="<?= $record->id ?>" name="id">
						</div>
						<h4 class="h4_product">Description</h4>
						<div class="form-group">
							<input placeholder="Business Name" value="<?= @($record->desc) ?>" name="desc" class="form-control" type="text">

						</div>

					

						<h4 class="h4_product">Icon</h4>
						<div class="form-group">
							<textarea name="icon" placeholder="icon"  class="form-control" colspan="6" rowspan="6"><?= @($record->icon) ?></textarea>
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
<script src="{{ asset('public/assets/js/jquery.filer.min.js') }}" type="text/javascript"></script>
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
                 "title": 
                 {
                        validators: 
                        {
                            notEmpty: 
                            {
                                message: 'Title is required'
                            }
                        }
                    },
                "desc": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Description is required'
                          }
                      }
                  }
              }
        })

		

	/*	$('.del_gal_img').click(function(){
			var id=$(this).attr('id');
			var token=$('#token').val();
			if(confirm('Are you sure ?'))
			{
				$(this).parent().parent().remove();
				$.ajax({
					method:'Post',
					data:{id:id,_token:token},
					url:"{{ url('products/deleteProductsImage') }}",
					success:function(resp)
					{
						//alert(resp);
					}
				});
			}
			else
			{
				return false;
			}
		});*/
	});
</script>

@endsection