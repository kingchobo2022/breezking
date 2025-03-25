@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Discount Code</a></li>
		<li class="breadcrumb-item active" aria-current="page">Discount Code List</li>
	  </ol>
	</nav>

	<div class="col-lg-12 stretch-card mb-3">
		<div class="card">
			<div class="card-body">
				<h6 class="card-title">Search Discount Code</h6>
				<form method="get" action="">
					<div class="row">
						<div class="col-sm-3">
							<div class="mb-3">
								<label for="" class="form-label">Id</label>
								<input type="text" name="id" value="{{ Request()->id }}" class="form-control" placeholder="Enter id">
							</div>
						</div>				
						<div class="col-sm-3">			
							<div class="mb-3">
								<label for="" class="form-label">User Name</label>
								<input type="text" name="user_name" value="{{ Request()->user_name }}" class="form-control" placeholder="Enter User Name">
							</div>
						</div>
						<div class="col-sm-3">			
							<div class="mb-3">
								<label for="" class="form-label">Discount Code</label>
								<input type="text" name="discount_code" value="{{ Request()->discount_code }}" class="form-control" placeholder="Enter Discount Code">
							</div>
						</div>
						<div class="col-sm-3">			
							<div class="mb-3">
								<label for="" class="form-label">Discount Price</label>
								<input type="text" name="discount_price" value="{{ Request()->discount_price }}" class="form-control" placeholder="Enter Discount Price">
							</div>
						</div>
					</div>
					<button class="btn btn-primary me-1">Search</button>
					<a href="{{ url('admin/discount_code') }}" class="btn btn-danger">Reset</a>

				</form>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Discount Code List</h4>
				<div class="d-flex align-items-center">

					<a href="{{ url('admin/discount_code/add') }}" class="btn btn-primary">Add Discount Code</a>
				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>ID</th>
                      <td>User</td>
                      <th>Discount Code</th>
                      <th>Discount Price</th>
                      <th>Expiry Date</th>
                      <th>Type</th>
                      <th>Usages</th>
					  <th>Created At</th>
					  <th>updated_at</th>
					  <th>Action</th>
					</tr>
				  </thead>
                  <tbody>
                  @foreach($discount_codes as $discount_code)
                    <tr>
                        <td>{{ $discount_code->id }}</td>
                        <td>{{ $discount_code->user_name }}</td>
                        <td>{{ $discount_code->discount_code }}</td>
                        <td>{{ $discount_code->discount_price }}</td>
                        <td>{{ $discount_code->expiry_date }}</td>
                        <td>{{ $discount_code->type == "0" ? "Percentage" : "Amount" }}</td>
                        <td>{{ $discount_code->usages == "1" ? "Uploaded" : "One Time" }}</td>
                        <td>{{ $discount_code->created_at }}</td>
                        <td>{{ $discount_code->updated_at }}</td>
                        <td><button type="button" class="btn btn-info bin-sm btn_edit" data-id="{{ $discount_code->id }}">Edit</button>
						<button type="button" class="btn btn-danger bin-sm btn_delete ms-1" data-id="{{ $discount_code->id }}">Delete</button>
					</td>
                    </tr>
                  @endforeach
                  </tbody>
				</table>
			  </div>
			  <div class="mt-3">
				{{ $discount_codes->appends(Request::except('page'))->links() }}
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	
	<form name="tmp_delete" action="{{ url('admin/discount_code/delete') }}" method="post" }}">
		@csrf
		@method('DELETE')
		<input type="hidden" name="id">
	</form>	  


</div>	


@endsection

@section('script')
<script>
const btn_edits = document.querySelectorAll('.btn_edit');
btn_edits.forEach(btn_edit => {
	btn_edit.addEventListener('click', (e) => {
		self.location.href="{{ url('admin/discount_code/edit') }}/" + btn_edit.dataset.id;
	});
});
const btn_deletes = document.querySelectorAll('.btn_delete');
btn_deletes.forEach(btn_delete => {
	btn_delete.addEventListener('click', (e) => {
		if (!confirm('삭제하시겠습니까?')) {
			return false;
		}

		document.tmp_delete.id.value = btn_delete.dataset.id;
		document.tmp_delete.submit();
	});
});
				
</script>
@endsection