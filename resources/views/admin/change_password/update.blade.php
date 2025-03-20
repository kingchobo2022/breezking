@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/change_password') }}">Change Pasword</a></li>
      <li class="breadcrumb-item active" aria-current="page">Update</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Add City</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/change_password/update') }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Old Password <span style="color: red"> *</span></label>
              <div class="col-sm-9">
					<input type="text" class="form-control" name="old_password" placeholder="Old Password" required>
              </div>
            </div>
			<hr>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">News Password <span style="color: red"> *</span></label>
              <div class="col-sm-9">
					<input type="text" class="form-control" name="new_password" placeholder="New Password" required>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Confirm Password <span style="color: red"> *</span></label>
              <div class="col-sm-9">
					<input type="text" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
              </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url('admin/change_password') }}" class="btn btn-secondary">Reset</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
