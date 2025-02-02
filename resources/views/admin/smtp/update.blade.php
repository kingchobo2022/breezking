@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  @include('inc_message')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/smtp') }}">SMTP Setting</a></li>
      <li class="breadcrumb-item active" aria-current="page">SMTP Setting</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">SMTP Setting</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/smtp_update') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">App Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="app_name" value="{{ $smtp->app_name }}" class="form-control" autocomplete="off" placeholder="Enter App Name" required>
                <span style="color: red;">{{ $errors->first('app_name') }}</span>
              </div>
            </div>
  
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Mail Mailer <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="mail_mailer" value="{{ $smtp->mail_mailer }}" class="form-control" autocomplete="off" placeholder="Enter Mail mailer" required>
                <span style="color: red;">{{ $errors->first('mail_mailer') }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Mail Host <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="mail_host" value="{{ $smtp->mail_host }}" class="form-control" autocomplete="off" placeholder="Enter Mail host" required>
                <span style="color: red;">{{ $errors->first('mail_host') }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Mail Port <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="mail_port" value="{{ $smtp->mail_port }}" class="form-control" autocomplete="off" placeholder="Enter Mail port" required>
                <span style="color: red;">{{ $errors->first('mail_port') }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Mail Username <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="mail_username" value="{{ $smtp->mail_username }}" class="form-control" autocomplete="off" placeholder="Enter Mail Username" required>
                <span style="color: red;">{{ $errors->first('mail_username') }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Mail Password <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="mail_password" value="{{ $smtp->mail_password }}" class="form-control" autocomplete="off" placeholder="Enter Mail Password" required>
                <span style="color: red;">{{ $errors->first('mail_password') }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Mail Encryption <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="mail_encryption" value="{{ $smtp->mail_encryption }}" class="form-control" autocomplete="off" placeholder="Enter Mail Encryption" required>
                <span style="color: red;">{{ $errors->first('mail_encryption') }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Mail From Address <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="mail_from_address" value="{{ $smtp->mail_from_address }}" class="form-control" autocomplete="off" placeholder="Enter Mail From Address" required>
                <span style="color: red;">{{ $errors->first('mail_from_address') }}</span>
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