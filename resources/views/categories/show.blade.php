<head>
    <title>Uzi-Shop - Home</title>
    @include('home.css')
</head>
<style>
    * {
        font-family: "Montserrat";
    }
    .center {
        margin: auto;
        width: 40%;
        text-align: center;
        padding: 30px;

    }
    h1 {
        font-size: 50px;
    }
    a:hover {
        text-decoration: underline;
        color: #f7444e;
    }

    .product-images {
        width: 100%;
        margin: 20px 0;
    }

    .product-images img {
        max-width: 100%;
        height: auto;
        object-fit: contain;
        border-radius: 5px;
    }
    .product-images img {
        width: 300px;
        height: 300px;
        object-fit: contain;
        margin-right: 10px;
    }
</style>
<body>

@include('sweetalert::alert')
@include('home.header')

<div class="container">
    <div style="margin-bottom: 10px;"><a style="font-weight: bold;" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Back</a></div>
    <h1 style="font-size: 30px;font-family: Gabriola;font-weight: bold;">{{ $category->category_name }}</h1>
    <br>
    <div class="container">
        <form class="d-flex" action="{{ route('search') }}" method="GET" style="margin: 0 auto;">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query" />
            <button class="btn btn-outline-success" style="height: 38px;" type="submit">Search</button>
        </form>
        <div id="search-results" class="row">

            @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="card mb-3" style="text-align: center;">
                        <div class="product-images">
                            <div class="slider">
                                <div><img src="{{ asset('product/' . $product->image) }}"></div>
                                <div><img src="{{ asset('product/' . $product->image1) }}"></div>
                                <div><img src="{{ asset('product/' . $product->image2) }}"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title" style="font-size: 16px;font-weight: bold">{{ $product->title }}</h4>
                            <p class="card-text" style="font-size: 12px;">{{ $product->description }}</p>
                            <div class="detail-box">
                                @if ($product->discountprice!=null)
                                    <h6 style="display: inline-block; font-weight: bold; margin-right: 10px;">
                                        Price: ${{$product->discountprice}}
                                    </h6>
                                    <h6 style="display: inline-block; text-decoration: line-through; color: red; font-weight: bold;">
                                        ${{ $product->price }}
                                    </h6>
                                @else
                                    <h6 style="display: inline-block; font-weight: bold;">
                                        Price: ${{ $product->price }}
                                    </h6>
                                @endif
                            </div>

                            <h4 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: #78CF8A;">In Stock</h4>
                            <div>
                                @for ($i = 0; $i < $product->averageRating(); $i++)
                                    <i class="fa fa-star" style="color: #ff9800;"></i>
                                @endfor
                                {{ $product->averageRating() }}
                                ({{ $product->ratings->count() }})
                            </div>
                            <br>
                            <a href="{{ url('product-details', $product->id) }}" class="btn btn-primary" style="margin-left: 10px; padding: 0.5rem 1rem;">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>

    $(document).ready(function(){
        $('.slider').slick({
            dots: false,
            arrows: false,
            prevArrow: '<button type="button" class="slick-prev">&#8249;</button>',
            nextArrow: '<button type="button" class="slick-next">&#8250;</button>',
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            variableWidth: true,
            centerMode: true,
            variableWidth: true,
            draggable: true,
            autoplay: true,
            autoplaySpeed: 2000
        });
    });


</script>
</body>

</html>
