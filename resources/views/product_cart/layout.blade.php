<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart Function</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .dropdown {
            float: right;
            padding-right: 30px;
        }
        .dropdown .dropdown-menu {
            padding: 20px;
            top: 30px !important;
            width: 350px !important;
            left: 0 !important;
            box-shadow: 0 5px 30px black;
        }
        .dropdown-menu:before {
            content: " ";
            position: absolute;
            top: -20px;
            right: 50px;
            border: 10px solid transparent;
            border-bottom-color: #fff;
        }
        .fs-8 {
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row navbar-light bg-light pt-2 pb-2">
            <div class="col-lg-10">
                <h3 class="mt-2">Add to Cart Function</h3>
            </div>
            <div class="col-md-2 text-right main-section">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle mt-1" data-bs-toggle="dropdown">
                        <i class="fa fa-shopping-cart"></i> Cart <span class="badge rounded-pill bg-danger text-white"> {{ count ((array) session('cart')) }}</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                           <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart"><span class="badge rounded-pill bg-danger text-white ms-1">{{ count ((array) session('cart')) }}</span></i>  
                           </div> 
                            @php 
                                $total = 0;
                            @endphp
                            @foreach( (array) session('cart') as $id => $item )
                                @php 
                                    $total += ($item['price'] * $item['quantity']);
                                @endphp 
                            @endforeach

                            <div class="col-lg-6 col-sm-6 col-6 text-end">
                                <p><strong>Total : {{ number_format($total) }}원 </strong></p>
                            </div>
                        </div>
                        @if(session('cart'))
                          @foreach( (array) session('cart') as $id => $item )
                        <div class="row cart-detail pb-3 pt-2">
                            <div class="col-lg-4 col-sm-4 col-4">
                                <img src="{{ asset('product/'. $item['image']) }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                <div class="mb-0">{{ $item['name'] }}</div>
                                <span class="fs-8 text-info">Price : {{ number_format($item['price']) }}원 </span> <br>
                                <span class="fs-8 fw-lighter">Quantity: {{ $item['quantity'] }}</span>
                            </div>
                        </div>
                          @endforeach
                        @endif

                        <div class="text-center">
                            <a href="{{ route('cart') }}" class="btn btn-info">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 offset-md-1">
                @yield('content')
            </div>
        </div>
    </div>
    @yield('script')
</body>

</html>