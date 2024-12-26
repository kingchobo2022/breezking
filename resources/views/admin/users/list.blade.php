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
                  <td>{{ $row->role }}</td>
                  <td>{{ $row->status }}</td>
                  <td>{{ date('Y-m-d', strtotime($row->created_at) ) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>



</div>
@endsection