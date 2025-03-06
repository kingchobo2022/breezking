@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  @include('inc_message')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/send_pdf') }}">Send PDF</a></li>
      <li class="breadcrumb-item active" aria-current="page">Send PDF</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">SMTP Setting</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/send_pdf') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Email ID<span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Enter Email ID" required>

              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Subject<span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="subject" class="form-control" autocomplete="off" placeholder="Enter Subject" required>

              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Message<span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="message" class="form-control" autocomplete="off" placeholder="Enter Message" required>

              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">PDF<span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="file" name="doc_file" class="form-control" accept="application/pdf" autocomplete="off" placeholder="Enter Message" required>

              </div>
            </div>
  
  

            <button type="submit" class="btn btn-primary me-2">Send PDF Email</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection