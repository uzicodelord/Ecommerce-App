<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .title_deg {
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            padding-bottom: 50px;
        }
        .table_deg {
            border: 2px solid #fff;
            width: 100%;
            margin: auto;
            text-align: center;
        }
        .th_deg {
            background-color: #212529;
        }
        .img-size {
            width: 200px;
            height: 200px;
            margin-left: 105px;
        }
    </style>
</head>
<body>

@include('sweetalert::alert')


<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper bg-dark">
            <h1 class="title_deg">All Orders</h1>
            <form method="GET" action="{{ route('admin.orders.search') }}" class="form-inline">
                <div class="form-group mb-2">
                    <label for="search" class="sr-only">Search orders:</label>
                    <input type="text" class="form-control" name="search" id="search" placeholder="Enter order name or ID">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </form>

            <table class="table_deg">
                <tr class="th_deg">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Attribute</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Delivered</th>
                    <th>E-mail</th>
                </tr>

                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ $order->price }}</td>
                    <td>{{ $order->attribute_value }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td>
                        <img class="img-size" src="{{ asset('product/' . $order->image) }}">
                    </td>
                    <td>
                        @if ($order->delivery_status=="Processing")
                        <a href="{{ url('delivered', $order->id) }}" class="btn btn-primary">Delivered</a>
                        @else
                        <p style="color: forestgreen;">Delivered</p>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('sendmail', $order->id) }}" class="btn btn-secondary">Send Email</a>
                    </td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>
