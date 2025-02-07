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