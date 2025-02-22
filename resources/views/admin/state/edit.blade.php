@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/state') }}">State</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit State</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Edit State</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/state/edit/'. $state->id) }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Country Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="countries_id" id="" class="form-control">
                  <option value="">Select Country Name</option>
                  @foreach ($countries as $country)
                      <option value="{{ $country->id }}" {{ ($country->id == $state->countries_id) ? 'selected' : '' }}>{{ $country->country_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">State Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="state_name" value="{{ $state->state_name }}" class="form-control" placeholder="State Name" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url('admin/state') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection