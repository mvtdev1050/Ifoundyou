@extends('layouts.layout_admin')
@section('title')
     Testimonials
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')
<style type="text/css">
	.editCat span{
		background-color: green;
	}	
	.deleteCat span{ 
		background-color: rgb(203,80,80);
	}
</style>
<link href="{{  asset('public/assets/css/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>

<!--========== END app aside -->

<!-- navbar search -->
<!-- <a href="skype:revinfotech26?call">Link will initiate Skype call to username</a>
 --><div id="navbar-search" class="navbar-search collapse">
  <div class="navbar-search-inner">
    <form action="#">
      <span class="search-icon"><i class="fa fa-search"></i></span>
      <input class="search-field" type="search" placeholder="search..."/>
    </form>
    <button type="button" class="search-close" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
      <i class="fa fa-close"></i>
    </button>
  </div>
  <div class="navbar-search-backdrop" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false"></div>
</div><!-- .navbar-search -->

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">

<div class="wrap">
	<section style="margin-top:50px" class="app-content">

		<div class="row">
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
			<div class="col-md-12">
				<header class="widget-header">
						<button data-toggle="modal" data-target="#AddModal" class="btn mw-md btn-primary">Add New</button>
					</header>
				<div id="profile-tabs" class="nav-tabs-horizontal white m-b-lg col-md-8">

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane in active fade" id="profile-stream">
						<?php 
							if(!empty($testimonials)){
						foreach($testimonials as $listing){ ?>
							<div class="media stream-post">
								<div class="media-left pull-left">
									<div class="avatar avatar-lg avatar-circle">
										<img <?php if(!empty($listing->image)){ ?> src="/public/images/<?=  $listing->image ?>" <?php   } else{ ?> src="/public/images/dummy_user.png" <?php } ?> alt="">
									</div>
								</div>
								<div class="pull-right">
										 
									<!-- <a class="editCat" id="<?= $listing->id ?>" ref="<?= $listing->heading ?>" rel="<?= $listing->content ?>"  data-toggle="modal" data-target="#EditcategoryModal">
										<span class="app-resch-btn" title="View">
											<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
										</span>
									</a> -->
									<a class="deleteCat" id="<?= $listing->id ?>"  data-toggle="modal" data-target="#DeleteModal">
										<span class="app-resch-btn delBtn" title="View">
											<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
										</span>
									</a>

								</div>
								<div class="media-body">
									<h4 class="media-heading m-t-xs">
										<a href="javascript:void(0)"><?= ucfirst(@($listing->heading)) ?></a>
									</h4>
									<div class="stream-body m-t-xl">
										<p><?= @($listing->content) ?></p>
									</div>
								</div>

							</div><!-- .stream-post -->

							<?php }}else{ ?>

							<h3 style="line-height:50px;padding:20px">No Testimonials Found!</h3>

							<?php } ?>
						</div><!-- .tab-pane -->
					</div><!-- .tab-content -->
				</div><!-- #profile-components -->
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- #dash-content -->
</div><!-- .row -->
<input type="hidden" value="oNGoozFnny7iJGk7ypu1S8uzjOfo0mizgvL9teFP" id="token" name="token">
<div id="EditcategoryModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <form method="Post" action="http://ojamove.devserver.co.in/admin/editMoveSize" id="editForm">
        <div class="modal-body">
          <div class="form-group m-0">
            <input type="hidden" name="_token" value="oNGoozFnny7iJGk7ypu1S8uzjOfo0mizgvL9teFP">
            <input type="hidden" value="" name="item_id" id="item_id">
            <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Name">
          </div>
        </div><!-- .modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div><!-- .modal-footer -->
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
   

   <div id="AddModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Testimonial</h4>
      </div>
      <form method="Post" enctype="multipart/form-data"  action="{{ url('/admin/addTestimonials') }}" id="addForm">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text"  name="heading" class="form-control" placeholder="Name">
          </div>
            <div class="form-group">
            <textarea name="content" class="form-control" placeholder="Content"></textarea>
          </div>
          <div class="form-group">
          	<div class="fileinput fileinput-new" data-provides="fileinput">

          			<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
          				<img src="{{ asset('/public/images/dummy_user.png')}}" alt="">
          			</div>
          			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
          			</div>
          			<div>
          				<span class="btn default btn-file">
          					<span class="fileinput-new">
          						Select image </span>
          						<span class="fileinput-exists">
          							Change </span>
          							<input name="file" type="file">
          						</span>
          						<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
          							Remove </a>
          						</div>
          					</div>

          				</div>
        </div><!-- .modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div><!-- .modal-footer -->
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<div id="DeleteModal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Delete</h4>
			</div>
			<form method="Post" action="{{ url('/admin/deleteTestimonial') }}" >
				<div class="modal-body">
					<h5>Do you really want to delete this ?</h5>
				</div><!-- .modal-body -->
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="modal-footer">
					<input type="hidden" name="item_id" value="" id="item_del_id">
					<button type="submit" class="btn btn-danger" >Delete</button>
				</form>
			</div><!-- .modal-footer -->
		</div><!-- /.modal-content -->
	</div>
</main>
<input type="hidden" value="{{ csrf_token() }}" id="token" name="">
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.raty.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script type="text/javascript">
	$(document).on('change','.selectDisp',function(){
		var disp_id=$(this).val();
		var token=$('#token').val();
		localStorage.setItem('disp_id',disp_id);
		if(disp_id != 0){
		$('#date').val("");
			$.ajax({
				method:'Post',
				data:{disp_id:disp_id,_token:token},
				url:"{{ url('/admin/getAjaxReviews') }}",
				success:function(resp)
				{
					$('#profile-stream').html(resp);
				}
			});
		}
	});

	$(document).ready(function() {
	$( "#date" ).datepicker({
 	   dateFormat:'yy-mm-dd',
       changeMonth: true,
       changeYear: true,
       onSelect: function(date) {
       	  var token=$('#token').val();
       	  var disp_id=localStorage.getItem('disp_id');
           $.ajax({

           		method:'Post',
           		data:{disp_id:disp_id,date:date,_token:token},
           		url:"{{ url('/admin/getAjaxReviewsByDate') }}",
           		success:function(resp)
           		{
           			if(resp != ""){
           				$('#profile-stream').html(resp);
           			}
           			else
           			{
           				$('#profile-stream').html('No Reviews found');
           			}
           		}

           });
        }
    });

      $('#addForm').formValidation({
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
                 "heading": 
                 {
                        validators: 
                        {
                            notEmpty: 
                            {
                                message: 'Field is required'
                            }
                        }
                    },
                "content": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  },
            }
        });

      $('.deleteCat').click(function(){
      		var a=$(this).attr('id');
      		$('#item_del_id').val(a);
      });	
      
});
</script>
@endsection

@section('css')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<style type="text/css">
		.m-t-xl
		{
			margin-top:20px !important; 
		}
		.filter
		{
			margin:20px;
			width:200px;
		}
	</style>
@endsection