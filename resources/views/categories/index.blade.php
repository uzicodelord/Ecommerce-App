<!DOCTYPE html>
<html>
<head>
    <title>Uzi-Shop - Categories</title>
    @include('home.css')
    <style>
        .center {
            margin: auto;
            width: 40%;
            text-align: center;
            padding: 30px;
        }
    </style>
</head>
<body>

@include('sweetalert::alert')

<div>
    <!-- header section strats -->
    @include('home.header')
    <div class="center">
<ul class="list-group">
    @foreach ($categories as $category)
        <li class="list-group-item bg-transparent" >
            <a href="{{ route('category.show', $category->category_name) }}">{{ $category->category_name }}</a>
        </li>
    @endforeach
</ul>
    </div>
</div>
</body>
</html>
