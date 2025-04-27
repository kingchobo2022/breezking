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

	<div class="row mb-2">
		<div class="col-lg-12 stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">Search Product Cart</h6>
					<form action="" method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="mb-3">
									<label for="" class="form-label">Id</label>
									<input type="text" name="id" value="{{ Request()->id }}" class="form-control" placeholder="Enter id">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">Name</label>
									<input type="text" name="name" value="{{ Request()->name }}" class="form-control" placeholder="Enter Name">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">Price</label>
									<input type="text" name="price" value="{{ Request()->price }}" class="form-control" placeholder="Enter Price">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="mb-3">
									<label for="" class="form-label">Created At</label>
									<input type="date" name="created_at" value="{{ Request()->created_at }}" class="form-control" placeholder="Enter Created At">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="mb-3">
									<label for="" class="form-label">Updated At</label>
									<input type="date" name="updated_at" value="{{ Request()->updated_at }}" class="form-control" placeholder="Enter Created At">
								</div>
							</div>

						</div>
						<button type="submit" class="btn btn-primary me-1">Search</button>
						<a href="{{ url('admin/product_cart') }}" class="btn btn-danger">Reset</a>
					</form>
				</div>
			</div>
		</div>
	</div>


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
@php 
	$totalPrice = 0;
@endphp 					
					@forelse($product_carts as $product_cart)
				      @php 
					  	$totalPrice = $totalPrice + $product_cart->price;
					  @endphp
					<tr>
						<td>{{ $product_cart->id }}</td>
						<td>{{ $product_cart->name }}</td>
						<td>{{ $product_cart->description }}</td>
						<td><img src="{{ asset('product/'. $product_cart->image) }}"></td>
                        <td>{{ number_format($product_cart->price) }}</td>
						<td>{{ date('Y-m-d H:i', strtotime($product_cart->created_at)) }}</td>
						<td>{{ date('Y-m-d H:i', strtotime($product_cart->updated_at)) }}</td>
						<td>
							<a href="{{ url('admin/product_cart/edit/'. $product_cart->id) }}" class="btn btn-primary btn-sm">Edit</a>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="100%">Data not found</td>
					</tr>
					@endforelse	
					<tr>
						<th colspan="4">Total</th>
						<td>{{ number_format($totalPrice) }}</td>
						<td colspan="2"></td>
					</tr>
				  </tbody>
				</table>
			  </div>
			  <div class="mt-3">
				{{ $product_carts->appends(Request::except('page'))->links() }}	
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection