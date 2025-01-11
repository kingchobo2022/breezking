@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  @include('inc_message')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">유저</a></li>
      <li class="breadcrumb-item active" aria-current="page">유저목록</li>
    </ol>
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
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->username }}</td>
                  <td>{{ $row->email }}</td>
                  <td>
                    @if( !empty($row->photo) )
                    <img src="{{ asset('upload/'. $row->photo ) }}" class="wd-80 ht-80 rounded-circle">
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
                    @if ($row->status == 'active')
                      <span class="badge bg-danger">{{ $row->status }}</span>    
                    @else
                    <span class="badge bg-secondary">{{ $row->status }}</span>    
                    @endif
                    

                  </td>
                  <td>{{ date('Y-m-d', strtotime($row->created_at) ) }}</td>
                  <td><a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/view/'. $row->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm me-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> <span class="">보기</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/edit/'. $row->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">수정</span></a>
                  
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