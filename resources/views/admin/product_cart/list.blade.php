@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Product Cart</a></li>
		<li class="breadcrumb-item active" aria-current="page">Product Cart List</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Product Cart List</h4>
				<div class="d-flex align-items-center">

					<a href="{{ url('admin/product_cart/add') }}" class="btn btn-primary">Add Product Cart</a>
				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>ID</th>
					  <th>Name</th>
					  <th>Description</th>
					  <th>Image</th>
                      <th>Price</th>
					  <th>Created At</th>
					  <th>updated_at</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  </tbody>
				</table>
			  </div>
			  <div class="mt-3">

			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection