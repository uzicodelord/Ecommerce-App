<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .input-color {
            color: black;
        }
        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 2px solid #212529;
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
            <div class="div_center">
                <h1 class="h2_font">Add Category</h1>
                <form action="{{ url('add_category') }}" method="POST">
                    @csrf
                    <input class="input-color" type="text" name="category" placeholder="Name of category">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add">
                </form>
            </div>

            <table class="center">

                <tr>
                    <td>Category Name</td>
                    <td>Action</td>

                </tr>
                @foreach($data as $data)
                <tr>
                    <td>{{ $data->category_name }}</td>
                    <td>

                        <a class="btn btn-danger" href="{{ url('deleteCategory', $data->id) }}">Delete</a>
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
