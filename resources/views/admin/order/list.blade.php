@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Order</a></li>
		<li class="breadcrumb-item active" aria-current="page">Order List</li>
	  </ol>
	</nav>

	{{-- Search Start --}}
	<div class="row">
		<div class="col-lg-12 stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">Search Order</h6>
					<form method="get" action="">
						<div class="row">
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">Id</label>
									<input type="text" name="id" value="{{ Request()->id }}" class="form-control" placeholder="Enter id">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label for="" class="form-label">Product Title</label>
									<input type="text" name="title" value="{{ Request()->title }}" class="form-control" placeholder="Enter Product Title">
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
									<input type="date" name="updated_at" value="{{ Request()->updated_at }}" class="form-control" placeholder="Enter Updated At">
								</div>
							</div>
						</div>
						<button class="btn btn-primary me-1">Search</button>
						<a href="{{ url('admin/order') }}" class="btn btn-danger">Reset</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	{{-- Search End --}}

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Order List</h4>
				<div class="d-flex align-items-center">
				  <a href="{{ url('admin/order/add') }}" class="btn btn-primary">Add Order</a>
				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Product Name</th>
					  <th>색상</th>
					  <th>수량</th>
					  <th>Created At</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach ($orders as $order)
					<tr>
						<td>{{ $order->id }}</td>
						<td>{{ $order->title }}</td>
						<td>
							@foreach ($order->getColor as $color)
								{{ $color->name }}
							@endforeach
						</td>
						<td>{{ $order->qtys }}</td>
						<td>{{ $order->created_at }}</td>
						<td>
							<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/order/edit/'.$order->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">수정</span></a>
							<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/order/delete/'. $order->id) }}" onclick="return confirm('삭제하시겠습니까?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">삭제</span></a> 
						</td>
					</tr>	
					@endforeach
				  </tbody>
				</table>
			  </div>
			  <div class="mt-3">
				{{-- pagination --}}
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection