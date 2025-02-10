@extends('admin.admin_dashboard')
@section('admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.5/dist/css/lightbox.min.css">
<div class="page-content">
  @include('inc_message')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">유저</a></li>
      <li class="breadcrumb-item active" aria-current="page">유저목록</li>
    </ol>
    <div class="d-flex align-items-center">
      <a href="" class="btn btn-info me-1">{{ $totalAdmin }} Admin</a>
      <a href="" class="btn btn-success me-1">{{ $totalAgent }} Agent</a>
      <a href="" class="btn btn-danger me-1">{{ $totalUser }} User</a>
      <a href="" class="btn btn-warning me-1">{{ $totalActive }} Active</a>
      <a href="" class="btn btn-secondary me-1">{{ $totalInActive }} In Active</a>
      <a href="" class="btn btn-primary me-1">{{ $total }} Total</a>
    </div>
  </nav>

  {{-- Search Box Start --}}
  <div class="row mb-3">
    <div class="col-lg-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="cart-title">Search Users</h6>
          <form action="" method="get">
            <div class="row">
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Id</label>
                  <input type="text" name="id" value="{{ Request()->id }}" class="form-control" placeholder="Enter Id">
                </div>
              </div>
              <div class="col-sm-2">
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" name="name" value="{{ Request()->name }}" class="form-control" placeholder="Enter Name">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" value="{{ Request()->username }}" class="form-control" placeholder="Enter Username">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" value="{{ Request()->email }}" class="form-control" placeholder="Enter Email">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone" value="{{ Request()->phone }}" class="form-control" placeholder="Enter Phone">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Website</label>
                  <input type="text" name="website" value="{{ Request()->website }}" class="form-control" placeholder="Enter Website">
                </div>
              </div>
              <div class="col-sm-2">
                <div class="mb-3">
                  <label class="form-label">Role</label>
                  <select name="role" class="form-control">
                    <option value="">Select Role</option>
                    <option value="admin" {{ Request()->role == 'admin' ? 'selected':'' }}>admin</option>
                    <option value="agent" {{ Request()->role == 'agent' ? 'selected':'' }}>agent</option>
                    <option value="user" {{ Request()->role == 'user' ? 'selected':'' }}>user</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active" {{ Request()->status == 'active' ? 'selected':'' }}>active</option>
                    <option value="inactive" {{ Request()->status == 'inactive' ? 'selected':'' }}>inactive</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="mb-3">
                  <label class="form-label">Start Date</label>
                  <input type="date" name="start_date" value="{{ Request()->start_date }}" class="form-control" placeholder="Enter Start Date">
                </div>
              </div>

              <div class="col-sm-2">
                <div class="mb-3">
                  <label class="form-label">End Date</label>
                  <input type="date" name="end_date" value="{{ Request()->end_date }}" class="form-control" placeholder="Enter End Date">
                </div>
              </div>


            </div>
            <button type="submit" class="btn btn-primary me-2">Search</button>
            <a href="{{ url('admin/users') }}" class="btn btn-danger">Reset</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Search Box End --}}

  <div class="row">
    <div class="col-lg-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="card-title">유저목록</h4>
            <div class="d-flex align-items-center">
              <a href="{{ url('admin/users/add') }}" class="btn btn-primary">유저등록</a>
            </div>
          </div>
          

          <div class="table-responsive pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Photo</th>
                  <th>Phone</th>
                  <th>Website</th>
                  <th>Address</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($usersRs as $row)
                <tr class="table-info text-dark">
                  <td>{{ $row->id }}</td>
                  <td>
                    <input type="text" value="{{ $row->name }}" class="form-control">
                    <button class="btn btn-success mt-1 submitform" data-id="{{ $row->id }}">Save</button>
                  </td>
                  <td>{{ $row->username }}</td>
                  <td>{{ $row->email }}</td>
                  <td>
                    @if( !empty($row->photo) )
                    <a href="{{ asset('upload/'. $row->photo ) }}" data-lightbox="box-set1"><img src="{{ asset('upload/'. $row->photo ) }}" class="wd-80 ht-80 rounded-circle"></a>
                    @endif
                  </td>
                  <td>{{ $row->phone }}</td>
                  <td>{{ $row->website }}</td>
                  <td>{{ $row->address }}</td>
                  <td>
                    @if ($row->role == 'admin')
                    <span class="badge bg-danger">{{ $row->role }}</span>    
                    @elseif ($row->role == 'agent')
                    <span class="badge bg-primary">{{ $row->role }}</span>
                    @else
                    <span class="badge bg-danger">{{ $row->role }}</span>
                    @endif
                    
                  </td>
                  <td>
                    {{-- @if ($row->status == 'active')
                      <span class="badge bg-danger">{{ $row->status }}</span>    
                    @else
                    <span class="badge bg-secondary">{{ $row->status }}</span>    
                    @endif --}}

                    <select class="form-control changeStatus" data-id="{{ $row->id }}">
                      <option value="active"   {{ $row->status == 'active'   ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ $row->status == 'inactive' ? 'selected' : '' }}>In Active</option>
                    </select>
                    

                  </td>
                  <td>{{ date('Y-m-d', strtotime($row->created_at) ) }}</td>
                  <td><a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/view/'. $row->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm me-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> <span class="">보기</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/edit/'. $row->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">수정</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/delete/'. $row->id) }}" onclick="return confirm('삭제하시겠습니까?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">삭제</span></a>                    
                  
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="100%">검색결과가 존재하지 않습니다.</td>                    
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {!! $usersRs->appends(Request::except('page'))->links()  !!}
          </div>
        </div>
      </div>
    </div>
  </div>



</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.5/dist/js/lightbox.min.js"></script>
<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  document.querySelectorAll('.submitform').forEach(button => {
    button.addEventListener('click', function(){
      const input = this.parentElement.querySelector('input.form-control');
      const dataId= this.getAttribute('data-id');

      if (input) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ url('admin/users/update_name') }}', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        // 전송할 데이터 정의
        const params = `id=${encodeURIComponent(dataId)}&name=${encodeURIComponent(input.value)}`;
        xhr.send(params);

        // 요청이 성공적으로 완료된 경우 실행할 코드
        xhr.onload = function() {
          if (xhr.status == 200) {
            //console.log("Response:", xhr.responseText); 
            const json = JSON.parse(xhr.responseText);
            alert(json.success);
          } else {
            console.log("Request failed. Status : ", xhr.status);
          }
        }
      }
    });
  });

  const els = document.querySelectorAll('.changeStatus');
  els.forEach(function (el) {
    el.addEventListener("change", function() {
      const dataId = this.getAttribute("data-id");

      const xhr = new XMLHttpRequest();
      const url = "{{ url('admin/users/change_status') }}";
      const params = `?id=${encodeURIComponent(dataId)}&status=${encodeURIComponent(this.value)}`;
      xhr.open("GET", url + params, true);
      xhr.send();
      
      xhr.onload = function() {
        if (xhr.status == 200) {
          console.log("Response:", xhr.responseText);
          const json = JSON.parse(xhr.responseText);
          alert(json.success);
        } else {
          console.log("Response failed Status:", xhr.status);
        }
      }
    });
  });
</script>    
@endsection
