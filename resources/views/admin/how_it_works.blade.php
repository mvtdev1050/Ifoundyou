@extends('layouts.layout_admin')
@section('title')
     How it works
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')

<style type="text/css">
i.fa
{
	background-color: #ffffff;
    border-radius: 50%;
    color: #0f718e;
    font-family: "FontAwesome";
    font-size: 32px;
    height: 60px;
    margin-right: 10px;
    padding-top: 14px;
    text-align: center;
    vertical-align: middle;
    width: 60px;
}
</style>
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
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">For Providers</h4>
						<a class="btn mw-md btn-primary pull-right" href="{{ url('admin/how_it_works/add/') }}">Add New Step</a>
					</header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Steps</th>
										<th>Title</th>
										<th>Description</th>
										<th>icon</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($records)){
										$i=1;
										foreach($records as $key => $lising){
									 ?>
									<tr>
										<td>Step <?= $key+1 ?></td>
										<td><?= $lising->title ?></td>
										<td><?= @($lising->desc) ?></td>
										<td><?= @($lising->icon) ?></td>
										<td>
											<a href="{{ url('/admin/how_it_works/edit') }}/<?= $lising->id ?>">
												<span class="app-resch-btn" title="Edit">
														<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
												</span>
											</a>
										</td> 
									</tr>
									<?php  }} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>

		<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">For Jobs</h4>
					</header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Steps</th>
										<th>Title</th>
										<th>Description</th>
										<th>icon</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($records1)){
										$i=1;
										foreach($records1 as $key => $lising){
									 ?>
									<tr>
										<td>Step <?= $key+1 ?></td>
										<td><?= $lising->title ?></td>
										<td><?= @($lising->desc) ?></td>
										<td><?= @($lising->icon) ?></td>
										<td>
											<a href="{{ url('/admin/how_it_works/edit') }}/<?= $lising->id ?>">
												<span class="app-resch-btn" title="Edit">
														<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
												</span>
											</a>
										</td> 
									</tr>
									<?php  }} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
	</section>
</div>
 
<input type="hidden" value="{{  csrf_token() }}" id="token" name="token">

   
</main>

@endsection

@section('css')
<style type="text/css">
	.glyphicon
	{
		line-height: 0px !important;
	}
</style>
@endsection

@section('script')
<script>
$(document).ready(function() {

	$('.statusF').change(function()
	{
		var val=$(this).val();
		var token=$('#token').val();
		var dispensary_id=$(this).attr('ref');
		$.ajax({
			method:'Post',
			data:{val:val,dispensary_id:dispensary_id,_token:token},
			url:"{{ url('/admin/changeStatus') }}",
			success:function(resp)
			{
				
			}
		});
	});




 });
</script>
@endsection