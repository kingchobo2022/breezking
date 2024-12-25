@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

  @include('inc_message')

  <div class="row profile-body">
    <!-- left wrapper start -->
    <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
      <div class="card rounded">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="card-title mb-0">About</h6>
          </div>
          <p>{{ Auth::user()->about  }}</p>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
            <p class="text-muted">{{ Auth::user()->name }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">UserName:</label>
            <p class="text-muted">{{ Auth::user()->username }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined:</label>
            <p class="text-muted">{{ date('Y년 m월 d일', strtotime(Auth::user()->created_at)) }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Lives:</label>
            <p class="text-muted">{{ Auth::user()->address  }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
            <p class="text-muted">{{ Auth::user()->email }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
            <p class="text-muted">{{ Auth::user()->website  }}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- left wrapper end -->
    <!-- middle wrapper start -->
    <div class="col-md-8 col-xl-6 middle-wrapper">
      <div class="row">
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <h6 class="card-title">Profile Update</h6>

            <form class="forms-sample" action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control"placeholder="Name" name="name" value="{{ $adminRow->name }}">
              </div>
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control"placeholder="Username" name="username" value="{{ $adminRow->username }}">
              </div>
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $adminRow->email }}">
                <span class="text-danger">{{ $errors->first('email') }}</span>
              </div>
              <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" placeholder="Pone" name="phone" value="{{ $adminRow->phone }}">
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password">
                ( 비밀번호를 변경하지 않으시려면 이 곳을 빈 상태로 유지해 주세요. )
              </div>
              <div class="mb-3">
                <label class="form-label">Profile Image</label>
                <input type="file" class="form-control" name="photo">
                @if( !empty($adminRow->photo) )
                <img src="{{ asset('upload/'. $adminRow->photo ) }}" class="wd-80 ht-80 rounded-circle mt-2">
                @endif
              </div>
              <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Address" name="address" value="{{ $adminRow->address }}">
              </div>
              <div class="mb-3">
                <label class="form-label">About</label>
                <textarea class="form-control" placeholder="about" name="about">{{ $adminRow->name }}</textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Website</label>
                <input type="text" class="form-control" placeholder="Website" name="website" value="{{ $adminRow->website }}">
              </div>

              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <button class="btn btn-secondary">Cancel</button>
            </form>

          </div>
        </div>
      </div>

      
    </div>
    <!-- middle wrapper end -->


    
  </div>

</div>

@endsection

