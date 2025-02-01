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
					  <td>Action</td>
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
						<td>
							<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/qrcode/edit/'. $qrcode->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">수정</span></a>
							<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/qrcode/delete/'. $qrcode->id) }}" onclick="return confirm('삭제하시겠습니까?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">삭제</span></a>                    							
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