@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">City</a></li>
		<li class="breadcrumb-item active" aria-current="page">City List</li>
	  </ol>
	</nav>

	<div class="row mb-2">
		<div class="col-lg-12 stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">Search City</h6>
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
									<label for="" class="form-label">Country Name</label>
									<input type="text" name="country_name" value="{{ Request()->country_name }}" class="form-control" placeholder="Enter Country Name">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">State Name</label>
									<input type="text" name="state_name" value="{{ Request()->state_name }}" class="form-control" placeholder="Enter Country Name">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">City Name</label>
									<input type="text" name="city_name" value="{{ Request()->ciy_name }}" class="form-control" placeholder="Enter City Name">
								</div>
							</div>

						</div>
						<button type="submit" class="btn btn-primary me-1">Search</button>
						<a href="{{ url('admin/city') }}" class="btn btn-danger">Reset</a>
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
				<h4 class="card-title">City List</h4>
				<div class="d-flex align-items-center">

					<a href="{{ url('admin/city/add') }}" class="btn btn-primary">Add City</a>
				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>ID</th>
					  <th>Country Name</th>
					  <th>State Name</th>
					  <th>City Name</th>
					  <th>Created At</th>
					  <th>updated_at</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach ($cities as $city)
					<tr>
						<td>{{ $city->id }}</td>
						<td>{{ $city->country_name }}</td>
						<td>{{ $city->state_name }}</td>
						<td>{{ $city->city_name }}</td>
						<td>{{ $city->created_at }}</td>
						<td>{{ $city->updated_at }}</td>
						<td>
							<a href="{{ url('admin/city/edit/'. $city->id) }}" class="btn btn-primary">Edit</a>
							<a href="{{ url('admin/city/delete/'. $city->id) }}" onclick="return confirm('삭제하시겠습니까?')" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					@endforeach  
				  </tbody>
				</table>
			  </div>
			  <div class="mt-3">
				{{ $cities->appends(Request::except('page'))->links() }}
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection