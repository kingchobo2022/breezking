@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  @include('inc_message')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">프로필</a></li>
      <li class="breadcrumb-item active" aria-current="page">프로필 변경</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">프로필 변경</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/my_profile/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="name" value="{{ $row->name }}" class="form-control" placeholder="Name">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Email <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="email" name="email" value="{{ old('email', $row->email) }}" class="form-control" autocomplete="off" placeholder="Email" required>

                <span style="color: red;">{{ $errors->first('email') }}</span>

              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">프로필 이미지 </label>
              <div class="col-sm-9">
                <input type="file" name="photo" class="form-control" placeholder="Name">
                @if(!empty($row->photo))
                <img src="{{ asset('upload/'. $row->photo) }}" style="max-width:100px; max-height:100px;">
                @endif
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">비밀번호</label>
              <div class="col-sm-9">
                <input type="password" name="password" class="form-control" placeholder="Password">
                (비밀번호를 변경하시려는 경우에 이 곳에 새로운 비밀번호를 넣어주세요.)
              </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">Update</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection