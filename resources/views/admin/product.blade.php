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
                <input class="text-color" type="text" name="description" placeholder="Description.." required>
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
                    <label for="color">Color</label>
                    <input type="text" name="name" id="color" class="text-color form-control" value="color">
                    <input type="text" name="attributes[0][value]" id="color_value" class="text-color form-control">
                <button class="btn btn-primary div_flex" type="button" id="add-attribute-value">Add Attribute Value</button>
                <div class="text-color" id="attribute-values-container"></div>
                </div>
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
    const attributeValuesContainer = document.getElementById('attribute-values-container');
    const addAttributeValueButton = document.getElementById('add-attribute-value');
    let attributeValueIndex = 0;

    addAttributeValueButton.addEventListener('click', () => {
        const attributeValueInput = `
    <div>
        <label for="attribute-${attributeValueIndex}-value">Attribute Value ${attributeValueIndex + 1}:</label>
        <input type="text" name="attributes[${attributeValueIndex}][value]" id="attribute-${attributeValueIndex}-value" required>
        <button type="button" class="remove-attribute-value">Remove</button>
    </div>
    `;
        attributeValuesContainer.insertAdjacentHTML('beforeend', attributeValueInput);
        attributeValueIndex++;

        // Add event listener to remove attribute value button
        const removeAttributeValueButtons = document.querySelectorAll('.remove-attribute-value');
        removeAttributeValueButtons.forEach(button => {
            button.addEventListener('click', () => {
                button.parentElement.remove();
                updateAttributeIndexes();
            });
        });
    });

    function updateAttributeIndexes() {
        const attributeValueInputs = attributeValuesContainer.querySelectorAll('input[name^="attributes"]');
        attributeValueIndex = attributeValueInputs.length;
        attributeValueInputs.forEach((input, index) => {
            input.name = `attributes[${index}][value]`;
            input.parentElement.querySelector('label').textContent = `Attribute Value ${index + 1}:`;
        });
    }

    // Add event listener to the form submit event
    const productForm = document.getElementById('product-form');
    productForm.addEventListener('submit', () => {
        updateAttributeIndexes();
    });


</script>
</html>
