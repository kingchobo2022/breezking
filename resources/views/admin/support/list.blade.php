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

	<div class="row mb-2">
		<div class="col-lg-12 stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">Search Support</h6>
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
									<label for="" class="form-label">Username</label>
									<select name="user_id" id="" class="form-select">
										<option value="">Select User</option>
										@foreach($users as $user)
										<option value="{{ $user->id }}" {{ Request()->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">Title</label>
									<input type="text" name="title" value="{{ Request()->title }}" class="form-control" placeholder="Enter Title">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">Status</label>
									<select name="status" id="" class="form-select">
										<option value="">Select Status</option>
										<option value="0" {{ Request()->status == '0' ? 'selected' : '' }}>Open</option>
										<option value="1" {{ Request()->status == '1' ? 'selected' : '' }}>Closed</option>
									</select>
								</div>
							</div>


						</div>
						<button type="submit" class="btn btn-primary me-1">Search</button>
						<a href="{{ url('admin/support') }}" class="btn btn-danger">Reset</a>
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
				<h4 class="card-title">Support List</h4>
				<div class="d-flex align-items-center">
					<button class="btn btn-danger" id="btn_delete">Delete</button>
				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
				      <th>Delete</th>		
					  <th>ID</th>
					  <th>User Name</th>
					  <th>Title</th>
					  <th>Description</th>
                      <th>Status</th>
					  <th>On and Off</th>
					  <th>Created At</th>
					  <th>updated_at</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
                    @forelse($supports as $support)
                    <tr>
						<td><input type="checkbox" value="{{ $support->id }}" class="del-all-option"></td>
                        <td>{{ $support->id }}</td>
                        <td>{{ $support->user->name }}</td>
                        <td>{{ $support->title }}</td>
                        <td>{{ $support->description }}</td>
                        <td>
							@if(Auth::user()->role == 'admin')
								<select name="status" class="form-select ChangeSupportSatus" data-id="{{ $support->id }}">
									<option value="0" {{ $support->status == '0' ? 'selected' : '' }}>Open</option>
									<option value="1" {{ $support->status == '1' ? 'selected' : '' }}>Closed</option>
								</select>
							@else
								{{ $support->status == '0' ? 'Open' : 'Closed' }}								
							@endif
						</td>
						<th>@if($support->status == '0')
							<a href="{{ url('admin/support/onoff/'. $support->id) }}" class="btn btn-success btn-sm">On</a>
							@else
							<a href="{{ url('admin/support/onoff/'. $support->id) }}" class="btn btn-danger btn-sm">Off</a>
							@endif
						</th>
                        <td>{{ $support->created_at }}</td>
                        <td>{{ $support->updated_at }}</td>
						<td><a href="{{ url('admin/support/reply/'. $support->id) }}" class="btn btn-success btn-sm">Reply</a></td>
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

@section('script')
<script>
const ChangeSupportSatus = document.querySelectorAll('.ChangeSupportSatus');
ChangeSupportSatus.forEach(selectbox => {
	selectbox.addEventListener("change", (e) => {
		//alert(selectbox.dataset.id);
		const f1 = new FormData();
		f1.append('id', selectbox.dataset.id);
		f1.append('status', selectbox.value);
		fetch("{{ url('admin/support/change_status') }}", {
			method: "POST",
			headers: {
				"X-CSRF-TOKEN": "{{ csrf_token() }}",
			},
			body: f1,
		})
		.then(response => {
			if(!response.ok) {
				throw new Error('통신에 실패했습니다.');
			}
			return response.json();
		})
		.then(data => {
			if (data.result == 'success') {
				alert('성공적으로 상탯값이 변경되었습니다.');
			} else {
				alert('알수 없는 오류가 발생했습니다.');
			}
		})
		.cathc(error => {
			alert(error.message);
		});
	});
});	

const btn_delete = document.getElementById('btn_delete');
btn_delete.addEventListener('click', () => {
	if(!confirm('삭제하시겠습니까?')) {
		return;
	}
	let delids = '';
	document.querySelectorAll('.del-all-option:checked').forEach(checkbox => {
			delids += checkbox.value + ','; 
	});
	self.location.href = "{{ url('admin/support/delete_item_multi?id=') }}" + delids; 
});	


</script>
@endsection