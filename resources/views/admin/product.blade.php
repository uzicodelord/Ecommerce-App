<!DOCTYPE html>
<html lang="en">
<head>
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
            <form action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="div_flex">
            <h1 class="h1_font">Add Product</h1>
                <label>Product Title</label>
                <br>
                <input class="text-color" type="text" name="title" placeholder="Title of the product" required>
            </div>
                <div class="div_flex">
                    <label>Product Description</label>
                    <br>
                    <textarea class="text-color" name="description" placeholder="Description.." required></textarea>
                </div>
                <div class="div_flex">
                <label>Product Price</label>
                <br>
                <input class="text-color" type="number" name="price" placeholder="Price of the product" required>
            </div>
            <div class="div_flex">
                <label>Discount Price</label>
                <br>
                <input class="text-color" type="number" name="discountprice" placeholder="Discount Price" required>
            </div>
            <div class="div_flex">
                <label>Product Quantity</label>
                <br>
                <input class="text-color" type="number" name="quantity" min="0" placeholder="Quantity" required>
            </div>
            <div class="div_flex">
                <label>Product Category:</label><br>
                <select style="width: 13%;" class="text-color" name="category" required>
                    <option value="" selected>Choose Category</option>
                    @foreach($category as $cg)
                    <option>{{ $cg->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="div_flex">
                <label>Product Image</label>
                <br>
                <input class="xxx" type="file" name="image" required>
            </div>
                <div class="div_flex">
                <label>Product Image</label>
                <br>
                <input class="xxx" type="file" name="image1">
            </div>
            <div class="div_flex">
                <label>Product Image</label>
                <br>
                <input class="xxx" type="file" name="image2">
            </div>
                <div class="div_flex">

                <div id="attributes-container">
                    <div class="form-group">
                        <input type="text" name="attribute_name[]" class="form-control attribute-name" placeholder="Attribute name">
                        <input type="text" name="attribute_values[]" class="form-control attribute-value" placeholder="Attribute values (comma separated)">
                    </div>
                </div>
                </div>
                <button type="button" id="add-attribute-btn" class="btn btn-primary">Add Attribute</button>
                <div class="div_flex">
                <br>
                <input type="submit" class="btn btn-primary" value="Add Product">
            </div>

        </form>
    </div>
    </div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
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
</html>
