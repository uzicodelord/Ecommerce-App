<title>Uzi-Shop - Product Details</title>
@include('home.css')

@include('home.header')

<div class="product-container" style="display: flex; justify-content: space-between; margin: 0 auto; max-width: 800px; padding: 30px;">
    @include('sweetalert::alert')

    <div class="product-images">
        <div class="slider">
            <div><img src="{{ asset('product/' . $product->image) }}"></div>
            <div><img src="{{ asset('product/' . $product->image1) }}"></div>
            <div><img src="{{ asset('product/' . $product->image2) }}"></div>
        </div>
    </div>
    <div class="detail-box" style="flex: 1; margin-left: 30px;">
        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">{{ $product->title }}</h3>
        <h4 style="font-size: 1.1rem; margin-bottom: 0.5rem;">Category: {{ $product->category }}</h4>
        <h4 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: #78CF8A;">In Stock</h4>
        @if ($product->discountprice != null)
            <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                <h4 style="color: #000; font-size: 1.3rem;margin-right: 10px;">${{ $product->discountprice }}</h4>
                <h4 style="color: #ff0000; text-decoration: line-through; font-size: 1.2rem; ">${{ $product->price }}</h4>
            </div>
        @else
            <h4 style="font-size: 1.5rem;">${{ $product->price }}</h4>
        @endif
        @if(count($attributes) > 0)
            <div class="attribute-grid">
                @foreach($attributes as $attribute)
                    <button type="button" class="btn btn-outline-secondary btn-attribute" onclick="addToCart('{{ $attribute->value }}')">{{ $attribute->value }}</button>
                @endforeach
            </div>
            <br>
        @else
            <p class="text-muted">There are no attributes for this product.</p>
        @endif
        <br>
        <form id="add-to-cart" action="{{ url('add-to-cart', $product->id) }}" method="POST" style="display: flex; align-items: center;">
            @csrf
            <div style="margin-right: 1rem;">
                <input type="number" name="quantity" value="1" min="1" style="width: 50px; font-size: 1.5rem; padding: 0.5rem; border-radius: 5px; border: 1px solid #ccc;"
                       id="quantity-input">
            </div>
            <div>
                <input type="hidden" name="attribute" id="attribute" value="">
                <input type="submit" value="Add to Cart" style="color: #fff;margin-left: -10px ;font-size: 1.5rem; border: none; padding: 0.5rem 1rem ;margin-bottom: 20px; border-radius: 5px;">
            </div>
        </form>
        </form>
    @if(Auth::check())
        <form action="{{ route('product.review.store', $product->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="comment">Leave a review:</label>
                {{ $product->comment }}
                <input type="text" class="form-control" name="comment" id="comment" placeholder="Write a review...">
            </div>
            <input type="submit" value="Submit Review"  style="color: #fff;font-size: 0.7rem; border: none; padding: 0.5rem 1rem ;margin-bottom: 20px; border-radius: 5px;">
        </form>
        @else
            <p class="text-muted" style="font-size: 13px;">You need to be logged in to submit a review.</p>
        @endif
        @if ($product->reviews->count() > 0)
            <div class="mt-4 bg-gray-100">
                <h4 class="mb-3">Reviews:</h4>
                <div class="review-grid" style="font-size: 14px;">
                    @foreach ($product->reviews()->paginate(3) as $review)
                        <div class="review-item">
                            <div class="font-weight-bold">{{ $review->user->name }}</div>
                            <div class="text-muted">{{ $review->created_at->format('F j, Y') }}</div>
                            <div>{{ $review->comment }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pagination-links">
                {{ $product->reviews()->paginate(3)->withQueryString()->links() }}
            </div>
        @else
            <p>No reviews yet.</p>
        @endif
        <!-- Product ratings form -->
        @if ($product->hasUserRated(auth()->id()))
            <br>
            <p>You have already rated this product.</p>
        @else
            <form action="{{ route('product.rating.store', $product->id) }}" method="POST" id="rating-form">
                @csrf
                <br>
                <div class="form-group">
                    <label for="rating">Rate this product:</label>
                    <div class="rating-stars">
                        <span class="fa fa-star" data-rating="1"></span>
                        <span class="fa fa-star" data-rating="2"></span>
                        <span class="fa fa-star" data-rating="3"></span>
                        <span class="fa fa-star" data-rating="4"></span>
                        <span class="fa fa-star" data-rating="5"></span>
                        <input type="hidden" name="rating" id="rating-value" value="0">
                    </div>
                    <button type="submit" hidden class="btn btn-primary" id="rating-submit">Submit rating</button>
                </div>
            </form>
        @endif
        <!-- Modal popup -->
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="login-modal-label">You need to be logged in to submit reviews and ratings</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Please log in or create an account to submit reviews and ratings for this product.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="login-cart" tabindex="-1" role="dialog" aria-labelledby="login-modal-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="login-modal-label">You need to be logged in to add items to the cart</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Please log in or create an account to add items to  cart.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Average rating display -->
        @if ($product->ratings->count() > 0)
            <div>
                Rating:
                @for ($i = 0; $i < $product->averageRating(); $i++)
                    <i class="fa fa-star" style="color: #ff9800"></i>
                @endfor
                {{ $product->averageRating() }}
                ({{ $product->ratings->count() }})
            </div>
        @endif
    </div>
</div>
<style>
    .btn-attribute.active {
        background-color: green;
    }

    .rating-stars {
        font-size: 24px;
        color: #ddd;
        display: inline-block;
        cursor: pointer;
    }

    .rating-stars .fa-star {
        margin-right: 5px;
    }

    .rating-stars .fa-star:hover,
    .rating-stars .fa-star.active {
        color: #ff9800;
    }
    .form-group {
        margin-bottom: 1rem;
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
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .product-images img {
        width: 300px;
        height: 300px;
        object-fit: contain;
        margin-right: 10px;
    }
    .product-container {
        display: flex;
        justify-content: space-between;
        max-width: 800px;
        margin: 0 auto;
        padding: 30px 20px;
    }
    @media (max-width: 768px) {
        .product-container {
            flex-direction: column;
            max-width: 100%;
        }

        .product-images {
            flex-basis: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }

        .detail-box {
            flex-basis: 100%;
            margin-left: 0;
        }
    }
</style>
<script>
    let stars = document.querySelectorAll('.rating-stars .fa-star');
    let ratingValue = document.querySelector('#rating-value');
    let ratingSubmit = document.querySelector('#rating-submit');

    stars.forEach(function(star) {
        star.addEventListener('click', function() {
            ratingValue.value = this.getAttribute('data-rating');
            ratingSubmit.click();
        });
    });

    $(document).ready(function(){
        $('.slider').slick({
            dots: false,
            arrows: false,
            prevArrow: '<button type="button" class="slick-prev">&#8249;</button>',
            nextArrow: '<button type="button" class="slick-next">&#8250;</button>',
            infinite: true,
            speed: 200,
            slidesToShow: 1,
            adaptiveHeight: true,
            variableWidth: true,
            centerMode: true,
            variableWidth: true
        });
    });

    $(function() {
        $('#rating-submit').click(function(event) {
            event.preventDefault();
            @if (! auth()->check())
            $('#login-modal').modal('show');
            @else
            $('#rating-form').submit();
            @endif
        });
    });

    const quantityInput = document.getElementById("quantity-input");
    quantityInput.addEventListener("click", (event) => {
        event.preventDefault();
    });

    $(function() {
        $('#add-to-cart').submit(function(event) {
            var clickedButton = $(document.activeElement).attr('id');
            if (clickedButton === 'add-to-cart-btn') {
                event.preventDefault();
                @if (! auth()->check())
                $('#login-cart').modal('show');
                @else
                $('form[action="{{ url('add-to-cart', $product->id) }}"]').submit();
                @endif
            }
        });
    });


    function addToCart(attributeValue) {
        // Get all buttons with the 'btn-attribute' class
        var buttons = document.querySelectorAll('.btn-attribute');

        // Loop through all buttons and remove the 'active' class
        buttons.forEach(function(button) {
            button.classList.remove('active');
        });

        // Find the button with the selected attributeValue and add the 'active' class
        var selectedButton = Array.from(buttons).find(function(button) {
            return button.textContent === attributeValue;
        });
        selectedButton.classList.add('active');

        // Set the selected attribute value to the hidden input field
        document.getElementById('attribute').value = attributeValue;
    }

</script>

<!-- footer end -->
</body>
</html>
