<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .center {
            margin: auto;
            width: 50%;
            border: 2px solid #212529;
            text-align: center;
            margin-top: 40px;
        }
        .h1_font {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }
        .img-size{
            width: 150px;
            height: 150px;
        }
        .th-color {
            background-color: #212529;
        }
        .th-deg{
            padding: 30px;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper bg-dark">
            @if (session()->has('message'))
                <div class="alert alert-primary">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif
            <h1 class="h1_font">All products</h1>
            <table class="center">
                <tr class="th-color">
                    <th class="th-deg">Title</th>
                    <th class="th-deg">Description</th>
                    <th class="th-deg">Quantity</th>
                    <th class="th-deg">Category</th>
                    <th class="th-deg">Price</th>
                    <th class="th-deg">Discount Price</th>
                    <th class="th-deg">Product Image</th>
                    <th class="th-deg">Edit</th>
                    <th class="th-deg">Delete</th>
                </tr>
                @foreach($product as $pr)
                <tr>
                    <td>{{ $pr->title }}</td>
                    <td>{{ $pr->description }}</td>
                    <td>{{ $pr->quantity }}</td>
                    <td>{{ $pr->category }}</td>
                    <td>{{ $pr->price }}$</td>
                    <td>{{ $pr->discountprice }}$</td>

                    <td>
                        <img class="img-size" src="product/{{ $pr->image }}">
                    </td>

                    <td>
                        <a href="{{ url('updateProduct', $pr->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <a href="{{ url('deleteProduct', $pr->id) }}" class="btn btn-danger">Delete</a>
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
