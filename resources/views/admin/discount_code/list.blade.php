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
                        <td>-</td>
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
	


</div>	  
@endsection