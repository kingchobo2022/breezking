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
						<td>~</td>
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