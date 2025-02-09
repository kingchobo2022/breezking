@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">유저</a></li>
      <li class="breadcrumb-item active" aria-current="page">유저수정</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">유저 수정</h6>

          <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{ url('admin/users/edit/'. $row->id) }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="name" value="{{ $row->name }}" class="form-control" placeholder="Name" required>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Username <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="username"  value="{{ $row->username }}" class="form-control" placeholder="Username" required>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Email <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="email" name="email"  value="{{ $row->email }}" class="form-control" autocomplete="off" placeholder="Email" required>

                <span style="color: red;">{{ $errors->first('email') }}</span>

              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Photo</label>
              <div class="col-sm-9">
                <input type="file" name="photo" class="form-control">
                @if ($row->getFile()) 
                    <img src="{{ $row->getFile() }}" class="w-25 p-1">  
                @endif
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Phone</label>
              <div class="col-sm-9">
                <input type="text" name="phone" value="{{ $row->phone }}" class="form-control" placeholder="Phone">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Role <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="role" class="form-control" required>
                  <option value="">Select Role</option>
                  <option value="admin" {{ $row->role == 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="agent" {{ $row->role == 'agent' ? 'selected' : '' }}>Agent</option>
                  <option value="user"  {{ $row->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Status <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="status" class="form-control" required>
                  <option value="">Select Status</option>
                  <option value="active" {{ $row->status == 'active' ? 'selected' : '' }}>Active</option>
                  <option value="inactive" {{ $row->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url('admin/users') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection