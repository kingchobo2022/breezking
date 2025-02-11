@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Blog /a></li>
		<li class="breadcrumb-item active" aria-current="page">Blog List</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Blog List</h4>
				<div class="d-flex align-items-center">
				  <a href="{{ route('admin.blog.add') }}" class="btn btn-primary">Add Blog</a>
				</div>
			  </div>
			  
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Title</th>
							<th>Slug</th>
							<th>Description</th>
							<th>Created At</th>
							<th>Updated At</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($blogs as $blog)
						<tr>
							<td>{{ $blog->id }}</td>
							<td>{{ $blog->title }}</td>
							<td>{{ $blog->slug }}</td>
							<td>{!! $blog->description !!}</td>
							<td>{{ $blog->created_at }}</td>
							<td>{{ $blog->updated_at }}</td>
						</tr>
						@empty
						<tr>
							<td colspan="100%">Not Found data</td>	
						</tr>							
						@endforelse
					</tbody>
				</table>
			  </div>

			  <div class="mt-2">
				{!! $blogs->appends(Request::except('page'))->links() !!}
			  </div>
	

			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection