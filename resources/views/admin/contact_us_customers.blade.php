@extends('layouts.layout_admin')
@section('title')
     Contact Customers
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')

	<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
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
			<!-- DOM dataTable -->
			<div class="col-md-1"></div>
			<div class="col-md-9">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">Customers</h4>
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
								<?php if(!empty($records)){
										$i=1;
										foreach($records as $lising){
									 ?>
									<tr style="text-align:center">
										<td><?= $i ?></td>
										<td><?= $lising->name ?></td>
										<td><?= $lising->email ?></td>
										<td><?= $lising->message ?></td>
									</tr>
									<?php $i++; }} ?>
								</tbody>
							</table>
						</div>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
			<div class="col-md-2"></div>
		</div><!-- .row -->
	</section><!-- .app-content -->
</div><!-- .wrap -->
  <!-- APP FOOTER -->

<input type="hidden" value="{{  csrf_token() }}" id="token" name="token">
<div id="EditcategoryModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Amminity</h4>
      </div>
      <form method="Post" action="{{ url('/admin/editMoveSize') }}" id="newCategoryForm">
        <div class="modal-body">
          <div class="form-group m-0">
            {{ csrf_field() }}
            <input type="hidden" value="" name="item_id" id="item_id">
            <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Category Name">
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
        <h4 class="modal-title">Add Move Size</h4>
      </div>
      <form method="Post" action="{{ url('/admin/addMoveSize') }}" id="newCategoryForm">
        <div class="modal-body">
          <div class="form-group m-0">
            {{ csrf_field() }}
            <input type="text" id="item_name" name="item" class="form-control" placeholder="Move Size Name">
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
				<h4 class="modal-title">Delete Move Size</h4>
			</div>
			<form method="Post" action="{{ url('/admin/deleteMoveSize') }}" >
				<div class="modal-body">
					<h5>Do you really want to delete this move size ?</h5>
				</div><!-- .modal-body -->
				{{ csrf_field() }}
				<div class="modal-footer">
					<input type="hidden" name="item_id" value="" id="item_del_id">
					<button type="submit" class="btn btn-danger" >Delete</button>
				</form>
			</div><!-- .modal-footer -->
		</div><!-- /.modal-content -->
	</div>
</main>

@endsection

@section('css')
<style type="text/css">
	.glyphicon
	{
		line-height: 0px !important;
	}
	.app-resch-btn
	{
		background-color: green;
	}
	.delBtn
	{
		background-color: #B30000;
	}
</style>
@endsection

@section('script')
<script>
$(document).ready(function() {

	$('.statusF').change(function()
	{
		var id=$(this).attr('ref');
		var token=$('#token').val();
		var val=$(this).val();
		$.ajax({
			method:'Post',
			data:{id:id,val:val,_token:token},
			url:"{{ url('/admin/changeMoveSizeStatus') }}",
			success:function(resp)
			{
				//alert(resp);
			}
		});
	});


	$('.editCat').click(function(){
	    var id=$(this).attr('id');
	    var name=$(this).attr('rel');
	    $('#item_id').val(id);
	    $('#item_name').val(name);
   });

	$('.deleteCat').click(function(){
	    var id=$(this).attr('id');
	    $('#item_del_id').val(id);
   });


 });
</script>
@endsection