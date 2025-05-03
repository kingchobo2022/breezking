@extends('product_cart.layout')

@section('content')

@include('inc_message')

<div class="row mt-4">
    @foreach ($product_carts as $product_cart)
    <div class="col-md-3">
        <div class="card text-center">
            <img src="{{ asset('product/'. $product_cart->image) }}" class="card-img-top" style="height:150px">
            <div class="caption cart-body">
                <h4>{{ $product_cart->name }}</h4>
                <p>{{ $product_cart->description }}</p>
                <p><strong>Price: </strong>{{ $product_cart->price }}</p>
                <a href="{{ route('add.cart', $product_cart->id) }}" class="btn btn-primary btn-sm">Add to cart</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('script')
<script>
</script>    
@endsection