@extends('admin.admin_dashboard')
@section('style')
<style>
.switch {
	position: relative;
	display: inline-block;
	width: 60px;
	height: 34px;
}
.switch input {
	opacity: 0;
	width: 0;
	height: 0;
}
.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ccc;
	transition: 0.4s;
	border-radius: 34px;
}
.slider:before {
	position: absolute;
	content: "";
	height: 26px;
	width: 26px;
	left: 4px;
	bottom: 4px;
	background-color: #fff;
	transition: 0.4s;
	border-radius: 50%;
}
input:checked + .slider {
	background-color: #2196F3;
}
input:checked + .slider:before {
	transform: translateX(26px);
}

</style>	
@endsection
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Color</a></li>
		<li class="breadcrumb-item active" aria-current="page">Color List</li>
	  </ol>
	</nav>

	<div class="row mb-2">
		<div class="col-lg-12 stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">Search Color</h6>
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
									<input type="text" name="name" value="{{ Request()->country_name }}" class="form-control" placeholder="Enter Name">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">Created At</label>
									<input type="date" name="created_at" value="{{ Request()->created_at }}" class="form-control" placeholder="Enter Created At">
								</div>
							</div>

						</div>
						<button type="submit" class="btn btn-primary me-1">Search</button>
						<a href="{{ url('admin/color') }}" class="btn btn-danger">Reset</a>
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
				<h4 class="card-title">Color List</h4>
				<div class="d-flex align-items-center">

					<a href="{{ route('admin.pdf_color') }}" class="btn btn-primary me-2">PDF Color</a>
					
					<a href="{{ route('admin.pdf_demo') }}" class="btn btn-primary me-2">PDF DEMO</a>

					<a href="{{ route('admin.color.add') }}" class="btn btn-primary">Add Color</a>
				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Name</th>
					  <th>Status</th>
					  <th>Created At</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach ($colors as $color)
					<tr class="table-info text-dark">
					  <td>{{ $color->id }}</td>
					  <td>{{ $color->name }}</td>
					  <td>
						<label class="switch">
							<input type="checkbox" class="statusCheck" data-id="{{ $color->id }}" {{ $color->status ? 'checked' : '' }}>
							<span class="slider"></span>
						</label>
					  </td>
					  <td>{{ $color->created_at }}</td>
					  <td>
						<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/color/edit/'.$color->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">수정</span></a>
						<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/color/delete/'. $color->id) }}" onclick="return confirm('삭제하시겠습니까?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">삭제</span></a>                    
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

@section('script')
<script>
const scs = document.querySelectorAll('.statusCheck');
scs.forEach(function(checkbox){
	checkbox.addEventListener('change', function(){
		const status = this.checked ? 1 : 0;
		const itemId = this.dataset.id;
		
		fetch("{{ url('admin/color/change_status') }}", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": "{{ csrf_token() }}"
			},
			body: JSON.stringify({
				id: itemId,
				status: status
			})
		})
		.then(response => response.json())
		.then(data => {
			alert(data.message);
		})
		.catch(error => {
			alert('Error: ' + error);
		});
	});
});
</script>	
@endsection