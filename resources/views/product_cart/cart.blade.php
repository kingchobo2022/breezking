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
    <tr data-id="">
        <td data-th="Product">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <img src="product/NXgEYssQre72ehYnSyKEngaBD5uTb7.jpg" width="100" height="150" class="img-responsive">
                </div>
                <div class="col-sm-9">
                    <h4 class="nomargin">Name</h4>
                </div>
            </div>
        </td>
        <td data-th="Price">1250</td>
        <td data-th="Quantity">
            <input type="number" value="1" class="form-control quantity update-cart" />
        </td>
        <td data-th="Subtotal" class="text-center">1250 * 4</td>
        <td class="actions" data-th="">
            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></button>
        </td>
    </tr> 
    </tbody>
    <tfoot>
        <tr>
            <td class="text-right" colspan="5">
                <h3><strong>Total 12220</strong></h3>
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
</script>
@endsection