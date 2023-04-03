
/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

function updateQuantity() {
    // Get the quantity input element
    var quantityInput = document.getElementById("quantity");

    // Get the hidden quantity field in the form
    var quantityField = document.getElementById("quantity-field");

    // Set the value of the hidden quantity field to the value of the quantity input
    quantityField.value = quantityInput.value;
}
