@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/discount_code') }}">Discount Code</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Discount Code</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Add Discount Code</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/discount_code/edit') }}">
            @csrf
            @method('PUT') 
            <input type="hidden" name="id" value="{{ $discount_code->id }}">
            
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">UserName <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="user_id" class="form-select">
                    @foreach($users AS $user)
                    <option value="{{ $user->id }}" {{ $user->id == $discount_code->user_id ? 'selected' : '' }}>{{ $user->name }}</option>"></option>
                    @endforeach
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Discount Code <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="discount_code" value="{{ $discount_code->discount_code }}" class="form-control" placeholder="Enter Discount Code" required>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Discount Price <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="discount_price" value="{{ $discount_code->discount_price }}" class="form-control" placeholder="Enter Discount Price" required>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Expiry Date <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="expiry_date" value="{{ $discount_code->expiry_date }}" class="form-control" placeholder="Enter Expiry Date" required>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Type <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="type" class="form-select" required>
                    <option value="0" {{ $discount_code->type == '0' ? 'selected' : '' }}>Percentage %</option>
                    <option value="1" {{ $discount_code->type == '1' ? 'selected' : '' }}>Amount</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Usages <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="usages" class="form-select" required>
                    <option value="1" {{ $discount_code->usages == '1' ? 'selected' : '' }}>Unlimited</option>
                    <option value="2" {{ $discount_code->usages == '2' ? 'selected' : '' }}>One Time</option>
                </select>
              </div>
            </div>



            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url('admin/discount_code') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

