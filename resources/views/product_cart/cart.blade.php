@extends('product_cart.layout')

@section('content')
<table class="table tabe-hover table-condensed" id="cart">
    <colgroup>
        <col>
        <col style="width:15%">
        <col style="width:15%">
        <col style="width:15%">
        <col style="width:5%">
    </colgroup>
    <thead>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th></th>
    </tr>        
    </thead>
    <tbody>
    @php 
        $total = 0;
    @endphp 
    @if(session('cart'))
      @foreach( (array) session('cart') as $id => $item )
        @php 
          $total += ($item['price'] * $item['quantity']);
        @endphp
    <tr data-id="{{ $id }}">
        <td data-th="Product">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <img src="{{ asset('product/'. $item['image']) }}"  width="100" height="100" class="img-responsive">
                </div>
                <div class="col-sm-9">
                    <h4 class="nomargin">{{ $item['name'] }}</h4>
                </div>
            </div>
        </td>
        <td data-th="Price">{{ number_format($item['price']) }}</td>
        <td data-th="Quantity">
            <input type="number" value="{{ $item['quantity'] }}" class="form-control quantity update-cart" />
        </td>
        <td data-th="Subtotal" class="text-center">{{ number_format($item['price'] * $item['quantity']) }} </td>
        <td class="actions" data-th="">
            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></button>
        </td>
    </tr> 
      @endforeach
    @endif
    </tbody>
    <tfoot>
        <tr>
            <td class="text-right" colspan="5">
                <h3><strong>Total {{ number_format($total) }}</strong></h3>
            </td>
        </tr>
        <tr>
            <td class="text-right" colspan="5">
                <a href="{{ url('product_cart') }}" class="btn btn-warning">
                <i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success">Checkout</button>
            </td>
        </tr>
    </tfoot>
</table>
@endsection

@section('script')
<script>
document.querySelectorAll('.update-cart').forEach(function(element){
    element.addEventListener('change', function(e){
        e.preventDefault();

        const tr = element.closest('tr');
        const id = tr.getAttribute('data-id');
        const quantity = element.value;

        fetch("{{ route('update.cart') }}", {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: id,
                quantity: quantity
            })
        })
        .then(function (response) {
            if (response.ok) {
                window.location.reload();
            } else {
                console.error('Server error');
            }
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    });    
});    

document.querySelectorAll('.remove-from-cart').forEach(function(element){
    element.addEventListener('click', function(e){
        e.preventDefault();

        // Guard Clause Pattern.
        if(!confirm('Are you sure you want to remove this item?')) {
            return;
        }

        const tr = element.closest('tr');
        const id = tr.getAttribute('data-id');
 
        fetch("{{ route('remove.cart') }}", {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: id
            })
        })
        .then(function (response) {
            if (response.ok) {
                window.location.reload();
            } else {
                console.error('Server error');
            }
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    });    
});    
</script>
@endsection