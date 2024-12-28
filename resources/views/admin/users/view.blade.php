@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">유저</a></li>
      <li class="breadcrumb-item active" aria-current="page">유저조회</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">유저조회</h6>

          <form class="forms-sample">
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ID</label>
              <div class="col-sm-9">
                {{ $userRow->id }}
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">name</label>
              <div class="col-sm-9">
                {{ $userRow->name }}
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                {{ $userRow->username }}
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                {{ $userRow->email }}
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone</label>
              <div class="col-sm-9">
                {{ $userRow->Phone }}
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Photo</label>
              <div class="col-sm-9">
                @if( !empty($userRow->photo) )
                <img src="{{ asset('upload/'. $userRow->photo ) }}" class="wd-80 ht-80 rounded-circle">
                @endif
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Role</label>
              <div class="col-sm-9">
                @if ($userRow->role == 'admin')
                <span class="badge bg-danger">{{ $userRow->role }}</span>    
                @elseif ($row->role == 'agent')
                <span class="badge bg-primary">{{ $userRow->role }}</span>
                @else
                <span class="badge bg-danger">{{ $userRow->role }}</span>
                @endif
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
                @if ($userRow->status == 'active')
                  <span class="badge bg-danger">{{ $userRow->status }}</span>    
                @else
                  <span class="badge bg-secondary">{{ $userRow->status }}</span>    
                @endif
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Address</label>
              <div class="col-sm-9">
                {{ $userRow->address }}
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">About</label>
              <div class="col-sm-9">
                {{ $userRow->About }}
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">등록일시</label>
              <div class="col-sm-9">
                {{ date('Y년 m월 d일 H시 i분', strtotime($userRow->created_at) ) }}
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">수정일시</label>
              <div class="col-sm-9">
                {{ date('Y년 m월 d일 H시 i분', strtotime($userRow->updated_at) ) }}
              </div>
            </div>
            
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">이전으로</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection