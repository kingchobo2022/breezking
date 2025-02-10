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
			  
	

			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection