@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/qrcode') }}">QRCode</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit QRCode</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Edit QRCode</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/qrcode/edit/'. $qrcode->id) }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Title <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="title" value="{{ $qrcode->title }}" class="form-control" placeholder="Enter Title" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Price <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="price" value="{{ $qrcode->price }}" class="form-control" placeholder="Enter Price" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Description </label>
              <div class="col-sm-9">
                <textarea name="description" class="form-control" placeholder="Enter Description">{{ $qrcode->description }}</textarea>
              </div>
            </div>


            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url('admin/qrcode') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection