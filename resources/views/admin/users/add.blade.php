@extends('admin.admin_dashboard')
@section('admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">유저</a></li>
      <li class="breadcrumb-item active" aria-current="page">유저등록</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">유저 등록</h6>

          <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{ url('admin/users/add') }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Username <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username" required>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Email <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="off" placeholder="Email" required>

                <span id="duplicate_message" style="color: red;">{{ $errors->first('email') }}</span>

              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Photo</label>
              <div class="col-sm-9">
                <input type="file" name="photo" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Phone</label>
              <div class="col-sm-9">
                <input type="text" name="phone" class="form-control" placeholder="Phone">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Role <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="role" class="form-control" required>
                  <option value="">Select Role</option>
                  <option value="admin">Admin</option>
                  <option value="agent">Agent</option>
                  <option value="user">User</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Status <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="status" class="form-control" required>
                  <option value="">Select Status</option>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <a href="{{ url('admin/users') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
const input_email = document.querySelector('input[name="email"]');  

input_email.addEventListener("blur", function(){
  console.log(this.value)  

  const f = new FormData()
  f.append('email', this.value)
  const xhr = new XMLHttpRequest()
  xhr.open('POST', '{{ url('admin/checkemail') }}', true)
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken)
  xhr.send(f)

  xhr.onload = function() {
     if (xhr.status == 200) {
       //console.log('Response : ' + xhr.responseText); // 서버 응답 
       const json = JSON.parse(xhr.responseText)
       if (json.exists) {
        document.getElementById('duplicate_message').textContent = '이미 사용중인 이메일입니다.' 
       } else {
        document.getElementById('duplicate_message').textContent = '' 
       }

     } else {
       console.error('Request failed. Status : ', xhr.status);
     }
  }
})
</script>    
@endsection