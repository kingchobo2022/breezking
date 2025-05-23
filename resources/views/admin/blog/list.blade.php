@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Blog</a></li>
		<li class="breadcrumb-item active" aria-current="page">Blog List</li>
	  </ol>
	</nav>

	<div class="col-lg-12 stretch-card mb-3">
		<div class="card">
			<div class="card-body">
				<h6 class="card-title">Search Blog</h6>
				<form method="get" action="">
					<div class="row">
						<div class="col-sm-3">
							<div class="mb-3">
								<label for="" class="form-label">Id</label>
								<input type="text" name="id" value="{{ Request()->id }}" class="form-control" placeholder="Enter id">
							</div>
						</div>				
						<div class="col-sm-5">			
							<div class="mb-3">
								<label for="" class="form-label">Title</label>
								<input type="text" name="title" value="{{ Request()->title }}" class="form-control" placeholder="Enter title">
							</div>
						</div>
						<div class="col-sm-3">			
							<div class="mb-3">
								<label for="" class="form-label">Slug</label>
								<input type="text" name="slug" value="{{ Request()->slug }}" class="form-control" placeholder="Enter slug">
							</div>
						</div>
					</div>
					<button class="btn btn-primary me-1">Search</button>
					<a href="{{ url('admin/blog') }}" class="btn btn-danger">Reset</a>

				</form>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Blog List</h4>
				<div class="d-flex align-items-center">

				  <button class="btn btn-danger me-2" id="btn_delete_all">Delete All</button>

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
							<th>Action</th>
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
							<td>
								<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/blog/view/'.$blog->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 icon-sm me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">보기</span></a>

								<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/blog/edit/'.$blog->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 icon-sm me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">수정</span></a>

								<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/blog/delete/'. $blog->id) }}" onclick="return confirm('삭제하시겠습니까?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">삭제</span></a> 
							</td>
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
				{{ $blogs->appends(Request::except('page'))->links('vendor.pagination.simple-bootstrap-5') }}
			  </div>
	

			</div>
		  </div>
		</div>
	  </div>
	


</div>	  

<form id="delete-form" method="POST" style="display:none">
	@csrf
	@method('DELETE')
</form>

@endsection

@section('script')
<script>
const btn_delete_all = document.getElementById('btn_delete_all');
btn_delete_all.addEventListener("click", function(){
	if(!confirm('전체 데이터를 모두 삭제하시겠습니까?')) {
		return;
	}

	const f = document.getElementById('delete-form');
	f.action = "{{ url('admin/blog/truncate') }}";
	f.submit();
});	
</script>	
@endsection