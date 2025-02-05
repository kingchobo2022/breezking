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
					  <th>수량</th>
					  <th>색상</th>
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
						<td></td>
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