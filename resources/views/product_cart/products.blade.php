@extends('product_cart.layout')

@section('content')
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-center">
            <img src="{{ asset('product\FhQpRzvIieYghJo3IV47LULYPIY9yO.png') }}" class="card-img-top">
            <div class="caption cart-body">
                <h4>Name</h4>
                <p>Description</p>
                <p><strong>Price: </strong>1250</p>
                <a href="" class="btn btn-primary btn-sm">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <img src="{{ asset('product\FhQpRzvIieYghJo3IV47LULYPIY9yO.png') }}" class="card-img-top">
            <div class="caption cart-body">
                <h4>Name</h4>
                <p>Description</p>
                <p><strong>Price: </strong>1250</p>
                <a href="" class="btn btn-primary btn-sm">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <img src="{{ asset('product\FhQpRzvIieYghJo3IV47LULYPIY9yO.png') }}" class="card-img-top">
            <div class="caption cart-body">
                <h4>Name</h4>
                <p>Description</p>
                <p><strong>Price: </strong>1250</p>
                <a href="" class="btn btn-primary btn-sm">Add to cart</a>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
</script>    
@endsection