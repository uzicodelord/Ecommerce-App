<head>
    <title>Uzi-Shop - Cart</title>
    @include('home.css')
</head>
<body>
@include('sweetalert::alert')
@include('home.header')
<div class="container mt-5">
    @if($cart->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="alert alert-warning">
                    Your cart is empty!
                </div>
                <a class="btn btn-primary" href="/" style="margin: 0 auto;">Shop Here</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Cart Items</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Attribute</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalprice = 0;
                                @endphp
                                @foreach($cart as $item)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img  src="{{ asset('product/' . $item->image) }}" class="img-fluid">
                                                </div>
                                                <div class="col-md-9">
                                                    <h6>{{ $item->product_title }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->attribute_id && $item->attribute_value)
                                                {{ $item->attribute_value }}
                                            @endif
                                        </td>
                                        <td>${{ $item->price }}</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" class="form-control text-center" value="{{ $item->quantity }}" readonly>
                                            </div>
                                        </td>

                                        <td>${{ $item->price * $item->quantity }}</td>

                                        <td>
                                            <a href="{{ url('remove-from-cart', $item->id) }}" class="btn btn-danger">Remove</a>
                                        </td>
                                    </tr>
                                    @php
                                        $totalprice += $item->price * $item->quantity;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>${{ $totalprice }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>${{ $totalprice * 0 }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>${{ $totalprice }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="{{ url('payment') }}" class="btn btn-primary btn-block">Cash On Delivery</a>
                            <a href="{{ url('stripe', $totalprice) }}" class="btn btn-primary btn-block">Card Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
</div>
