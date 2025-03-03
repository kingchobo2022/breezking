@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Address</a></li>
		<li class="breadcrumb-item active" aria-current="page">Address List</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Address List</h4>
				<div class="d-flex align-items-center">

					<a href="{{ url('admin/address/add') }}" class="btn btn-primary">Add Address</a>
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
					  <th>Address</th>
					  <th>Created At</th>
					  <th>Updated At</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  @forelse ($addresses as $address)
				  <tr>
					<td>{{ $address->id }}</td>
					<td>{{ $address->country_name }}</td>
					<td>{{ $address->state_name }}</td>
					<td>{{ $address->city_name }}</td>
					<td>{{ $address->address }}</td>
					<td>{{ $address->created_at }}</td>
					<td>{{ $address->updated_at }}</td>
					<td>~</td>
				  </tr>

				  @empty
					  
				  @endforelse
				</table>
			  </div>
			  <div class="mt-3">
				{{-- pagination --}}
				{{ $addresses->appends(Request::except('page'))->links() }}
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection