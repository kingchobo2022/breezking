@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">유저</a></li>
      <li class="breadcrumb-item active" aria-current="page">유저목록</li>
    </ol>
  </nav>


  <div class="row">
    <div class="col-lg-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">유저목록</h4>
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
                @foreach($usersRs as $row)
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
                  <td><a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/view/'. $row->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm me-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> <span class="">보기</span></a></td>
                </tr>
                @endforeach
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