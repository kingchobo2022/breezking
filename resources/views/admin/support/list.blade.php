@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Support</a></li>
		<li class="breadcrumb-item active" aria-current="page">Support List</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Support List</h4>
				<div class="d-flex align-items-center">

				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>ID</th>
					  <th>User Name</th>
					  <th>Title</th>
					  <th>Description</th>
                      <th>Status</th>
					  <th>Created At</th>
					  <th>updated_at</th>
					</tr>
				  </thead>
				  <tbody>
                    @forelse($supports as $support)
                    <tr>
                        <td>{{ $support->id }}</td>
                        <td>{{ $support->user->name }}</td>
                        <td>{{ $support->title }}</td>
                        <td>{{ $support->description }}</td>
                        <td>{{ $support->status }}</td>
                        <td>{{ $support->created_at }}</td>
                        <td>{{ $support->updated_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100%">Data not found.</td>
                    </tr>
                    @endforelse
				  </tbody>
				</table>
			  </div>
			  <div class="mt-3">
                {{ $supports->appends(Request::except('page'))->links() }}
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection