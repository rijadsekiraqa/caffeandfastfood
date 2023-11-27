    function calc_change() {
    var amount = parseFloat($('[name="amount"]').val()) || 0;
    var tendered = parseFloat($('[name="tendered"]').val()) || 0;
    var change = tendered - amount;
    $('#change').val(change.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
}
    function calc_total_amount() {
    var total = 0;
    $('#product-list tbody tr').each(function () {
    var qty = parseFloat($(this).find('[name="product_qty[]"]').val()) || 0;
    total += (parseFloat($(this).find('[name="product_price[]"]').val()) * qty);
});
    $('[name="amount"]').val(total.toFixed(2));
    $('#amount').text(total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    calc_change();
}
    function calc_product() {
    var total = 0;
    $('#product-list tbody tr').each(function () {
    var qty = parseFloat($(this).find('[name="product_qty[]"]').val()) || 0;
    var price = parseFloat($(this).find('[name="product_price[]"]').val()) || 0;

    // Ensure qty is at least 1
    qty = Math.max(1, qty);
    $(this).find('[name="product_qty[]"]').val(qty.toFixed(0)); // Set the value as a whole number

    var productTotal = qty * price;
    total += productTotal;

    $(this).find('.product_total').text(productTotal.toFixed(2));
});

    $('#product_total').text(total.toFixed(2));
    calc_total_amount();
}
    $(function(){
    $('body').addClass('sidebar-collapse')
    $('#payment_type').change(function(){
    var type = $(this).val()
    if(type == 1){
    $('#payment_code').addClass('d-none').attr('required', false)
}else{
    $('#payment_code').removeClass('d-none').attr('required', true)
}
})
    $('#product-list tbody tr').find('.rem-product').click(function(){
    var tr = $(this).closest('tr')
    if(confirm("Are you sure to remove "+(tr.find('.product_name').text())+" from product list?") === true){
    tr.remove()
    calc_product()
}
})
    $('#product-list tbody tr').find('[name="product_qty[]"]').on('input change', function(){
    var tr = $(this).closest('tr')
    var price = tr.find('[name="product_price[]"]').val()
    var qty = $(this).val()
    qty = qty > 0 ? qty : 0
    price = price > 0 ? price : 0
    var total = parseFloat(qty) * parseFloat(price)
    tr.find('.product_total').text(parseFloat(total).toLocaleString())
    calc_product()

})
    $('#tendered').on('input',function(){
    calc_change()
})
    $('.prod-item').click(function(){
    var id = $(this).attr('data-id')
    if($('#product-list tbody tr input[name="product_id[]"][value="'+id+'"]').length > 0){
    alert("Produkti eshte ne listen e shitjeve")
    return false;
}
    var name = ($(this).find('.card-body').text()).trim()
    var price = $(this).attr('data-price')
    var tr = $($('noscript#product-clone').html()).clone()
    tr.find('input[name="product_id[]"]').val(id)
    tr.find('input[name="product_price[]"]').val(price)
    tr.find('.product_name').text(name)
    tr.find('.product_price').text('x ' + parseFloat(price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    tr.find('.product_total').text(parseFloat(price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    $('#product-list tbody').append(tr)
    calc_product()
    tr.find('.rem-product').click(function(){
    if(confirm("A jeni i sigurt qe doni ta fshini "+name+" nga lista e shitjeve?") === true){
    tr.remove()
    calc_product()
}
})
    tr.find('[name="product_qty[]"]').on('input change', function () {
    var qty = $(this).val();
    qty = Math.max(1, qty); // Ensure qty is at least 1
    tr.find('[name="product_qty[]"]').val(Math.floor(qty)); // Set the value as a whole number

    var total = parseFloat(qty) * parseFloat(price);
    tr.find('.product_total').text(total.toFixed(2));
    calc_product();
});
})

})
