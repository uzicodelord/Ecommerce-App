
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

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination-wrapper .pagination {
        margin: 0;
    }

    .pagination-wrapper .page-item {
        margin: 0 5px;
    }

    .pagination-wrapper .page-link {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .pagination-wrapper .page-link:hover {
        color: #333;
        background-color: #f7f7f7;
        border-color: #ccc;
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
    .search-result {
        display: flex;
        align-items: center;
        list-style-type: none;
    }

    .search-result-image {
        width: 30px;
        float: left;
        margin-right: 10px;
    }

    .search-result-title {
        flex: 1;
    }

    .search-result-link {
        color: #000;
        font-weight: bold;
        text-decoration: none;
        margin-top: 5px;
        display: block;
        transition: all 0.3s ease;
    }

    .search-result-link:hover {
        color: #fff;
        background-color: #000;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
    }
</style>
<body>
@include('home.header')
@include('sweetalert::alert')
    <div class="container">

        <div class="container">
            <form class="d-flex" action="{{ route('search') }}" method="GET" style="margin: 0 auto;">
                <input id="search-input" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query" data-product="{{ json_encode($products) }}" />
            </form>
            <span id="search-results"></span>
            <br>
            <div class="row">

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
                                <div style="display: flex; justify-content: center;">
                                    <form action="{{ url('add-to-cart', $product->id) }}" method="POST">
                                        @csrf
                                        <div style="display: flex;">
                                            <input class="quan" type="number" name="quantity" value="1" min="1" style="width: 50px; border-radius: 5px; margin-right: 10px; height: 100%;">
                                            <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem; height: 100%;">Add to Cart</button>
                                        </div>
                                    </form>
                                </div>

                                <a href="{{ url('product-details', $product->id) }}" class="btn btn-primary" style="margin-left: 10px; padding: 0.5rem 1rem;">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
<div class="pagination-wrapper">
    {!! $products->links() !!}
</div>
<!-- end product section -->
<!-- why section -->
@include('home.why')
<!-- end why section -->
<!-- subscribe section -->
@include('home.subscribe')
<!-- end subscribe section -->
<!-- footer start -->
<!-- footer end -->
<script>
    $(document).ready(function(){
        initSlider();
    });

    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    const product = JSON.parse(searchInput.dataset.product);

    searchInput.addEventListener('input', function(event) {
        const query = event.target.value;

        // make an ajax request to fetch the search results
        fetch(`/search?q=${query}`)
            .then(response => response.json())
            .then(data => {
                // check if search query is empty and display nothing
                if (query.trim() === '') {
                    searchResults.innerHTML = '';
                }
                // check if search query has no matching products and display message
                else if (data.length === 0) {
                    searchResults.innerHTML = '<li class="search-result">No products found</li>';
                }
                // update the search results container with the search results
                else {
                    searchResults.innerHTML = data.map(product => `
    <li class="search-result">
        <img src="{{ asset('product/') }}/${product.image}" alt="${product.title}" class="search-result-image search-result-image--${product.id}">
        <a href="{{ url('product-details', ['id' => '']) }}/${product.id}" class="search-result-link">${product.title}</a>
    </li>
`).join('');
                }

            });
    });
    <!-- Start of LiveChat (www.livechat.com) code -->

        window.__lc = window.__lc || {};
        window.__lc.license = 15288222;
        ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
        </script>
        <!-- End of LiveChat code -->
</body>
</html>
