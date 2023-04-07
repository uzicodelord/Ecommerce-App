<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .div_center{
            text-align: center;
            padding: 40px;
        }
        .h1_font{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text-color {
            color: black;
        }
        label {
            display: inline-block;
            width: 200px;
        }

        .div_flex
        {
            text-align: center;
            padding-bottom: 15px;
        }
        .xxx {
            margin-left: 150px;
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
            <form action="{{ url('/updateProductConfirm', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="div_flex">
                    <h1 class="h1_font">Update Product</h1>
                    <label>Product Title</label>
                    <br>
                    <input class="text-color" type="text" name="title" placeholder="Title of the product" required
                    value="{{ $product->title }}">
                </div>
                <div class="div_flex">
                    <label>Product Description</label>
                    <br>
                    <textarea class="text-color" name="description" placeholder="Description.." required value="">{{$product->description}}</textarea>
                </div>
                <div class="div_flex">
                    <label>Product Price</label>
                    <br>
                    <input class="text-color" type="number" name="price" placeholder="Price of the product" required value="{{ $product->price }}">
                </div>
                <div class="div_flex">
                    <label>Discount Price</label>
                    <br>
                    <input class="text-color" type="number" name="discount_price" placeholder="Discount Price" required value="{{ $product->discountprice }}">
                </div>
                <div class="div_flex">
                    <label>Product Quantity</label>
                    <br>
                    <input class="text-color" type="number" name="quantity" min="0" placeholder="Quantity" required value="{{ $product->quantity }}">
                </div>
                <div class="div_flex">
                    <label>Product Category:</label><br>
                    <select style="width: 13%;" class="text-color" name="category" required>
                        <option value="{{ $product->category }}" selected>{{ $product->category }}</option>
                        @foreach($category as $cg)
                            <option value="{{ $cg->name }}">{{ $cg->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="div_flex">
                    <label>Current Image 1</label>
                    <br>
                    <img src="/product/{{$product->image}}" style="width: 150px;height: 150px;margin:auto; ">
                </div>
                <div class="div_flex">
                    <label>Current Image 2</label>
                    <br>
                    <img src="/product/{{$product->image1}}" style="width: 150px;height: 150px;margin:auto; ">
                </div>
                <div class="div_flex">
                    <label>Current Image 3</label>
                    <br>
                    <img src="/product/{{$product->image2}}" style="width: 150px;height: 150px;margin:auto; ">
                </div>

                <div class="div_flex">
                    <label>Product Image 1</label>
                    <br>
                    <input class="xxx" type="file" name="image">
                </div>
                <div class="div_flex">
                    <label>Product Image 2</label>
                    <br>
                    <input class="xxx" type="file" name="image1">
                </div>
                <div class="div_flex">
                    <label>Product Image 2</label>
                    <br>
                    <input class="xxx" type="file" name="image2">
                </div>
                <div class="div_flex">

                    <div id="attributes-container">
                        <div class="form-group">
                            @foreach($attributes as $attribute)
                            <input type="text" name="attribute_name[]" class="form-control attribute-name text-color" value="{{ $attribute->name }}">
                            <input type="text" name="attribute_values[]" class="form-control attribute-value text-color" value="{{ $attribute->value }}">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="div_flex">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Edit Product">
                </div>

            </form>
        </div>
    </div>
</div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
<script>
    $(document).ready(function() {
        $('#add-attribute-btn').click(function() {
            var container = $('#attributes-container');

            // Create new attribute input fields
            var attributeGroup = $('<div>').addClass('form-group');
            var attributeNameInput = $('<input>').attr('type', 'text').attr('name', 'attribute_name[]').addClass('form-control attribute-name').attr('placeholder', 'Attribute name');
            var attributeValueInput = $('<input>').attr('type', 'text').attr('name', 'attribute_values[]').addClass('form-control attribute-value').attr('placeholder', 'Attribute values (comma separated)');

            // Add the new attribute fields to the container
            attributeGroup.append(attributeNameInput).append(attributeValueInput);
            container.append(attributeGroup);
        });
    });
</script>
</body>
</html>
