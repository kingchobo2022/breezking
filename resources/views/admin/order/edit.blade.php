@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/order') }}">Order</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Edit Order</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/order/edit/' . $order->id) }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Product Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
               <select name="product_id" class="form-control">
                  <option value="">Select Product</option>
                  @foreach ($products as $product)
                      <option value="{{ $product->id }}" {{ $product->id == $order->product_id ? 'selected' : '' }}>{{ $product->title }}</option>
                  @endforeach
               </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Color <span style="color: red"> *</span></label>
              <div class="col-sm-9">
               @foreach ($colors as $color)
                  @php
                      $checked = '';
                  @endphp
                  
                  @foreach ($orderDetails as $orderDetail)
                      @if ($orderDetail->color_id == $color->id)
                          @php
                              $checked = 'checked';
                          @endphp
                      @endif
                  @endforeach

                  <div class="form-check">
                    <input class="form-check-input" name="color_id[]" {{ $checked }} type="checkbox" value="{{ $color->id }}" id="flexCheckDefault{{ $color->id }}">
                    <label class="form-check-label" for="flexCheckDefault{{ $color->id }}">
                      {{ $color->name }}
                    </label>
                  </div>

               @endforeach
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">수량 <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="number" name="qtys" value="{{ $order->qtys }}" class="form-control" required>
              </div>
            </div>            

            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url('admin/order') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection