$(document).ready(function (){
    $('table.shopping-bag-items a, table.shopping-bag-items div.quantity-minus, table.shopping-bag-items div.quantity-plus, div.oa-address a').remove();
    $('table.shopping-bag-items input.sb-quantity-input').prop('readonly', true).css('float', 'none');
});