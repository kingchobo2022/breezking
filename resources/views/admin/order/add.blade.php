@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/order') }}">Order</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Order</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Add Order</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/color/add') }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Product Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
               <select name="product_id" class="form-control">
                  <option value="">Select Product</option>
                  @foreach ($products as $product)
                      <option value="{{ $product->id }}">{{ $product->title }}</option>
                  @endforeach
               </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Color <span style="color: red"> *</span></label>
              <div class="col-sm-9">
               @foreach ($colors as $color)

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $color->id }}" id="flexCheckDefault{{ $color->id }}">
                    <label class="form-check-label" for="flexCheckDefault{{ $color->id }}">
                      {{ $color->name }}
                    </label>
                  </div>

               @endforeach
              </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <a href="{{ url('admin/order') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection