@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"> QRCode</a></li>
		<li class="breadcrumb-item active" aria-current="page"> QRCode List</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title"> QRCode List</h4>
				<div class="d-flex align-items-center">
				  <a href="{{ url('admin/qrcode/add') }}" class="btn btn-primary">Add QRCode</a>
				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Title</th>
					  <th>Price</th>
					  <th>Product Code</th>
					  <th>Description</th>
					  <th>Created At</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach ($qrcodes as $qrcode)
					<tr class="table-info text-dark">
						<td>{{ $qrcode->id }}</td>
						<td>{{ $qrcode->title }}</td>
						<td>{{ $qrcode->price }}</td>
						<td>
							{!! DNS2D::getBarCodeHTML($qrcode->product_code, 'QRCODE', 5, 5)  !!}
							{{ $qrcode->product_code }}
						</td>
						<td>{{ $qrcode->description }}</td>
						<td>{{ $qrcode->created_at }}</td>
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