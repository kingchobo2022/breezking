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
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">유저조회</h6>

          <form class="forms-sample">
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
              <div class="col-sm-9">
                
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                
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