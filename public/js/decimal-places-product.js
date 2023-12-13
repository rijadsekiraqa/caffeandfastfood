
    const priceInput = document.getElementById("price");

    priceInput.addEventListener("input", function () {
    // Get the current value of the input
    let value = priceInput.value;

    // Format the value with two decimal places
    value = parseFloat(value).toFixed(2);

    // Set the formatted value back to the input
    priceInput.value = value;
});
