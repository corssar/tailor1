$(document).ready(function(){
    $(document).on('keyup', '.sb-quantity-input', function(){
        $(this).val($(this).val().replace (/\D/, ''));
    });


});

var ShoppingBag = {
    data: null,
    action: null,
    delay: 750,
    timeout: null,

    showLoader: function(){
        $('#shopping-table-loader').show();
    },

    hideLoader: function(){
        $('#shopping-table-loader').hide();
    },

    queue: function(itemId){
        var base = this;
        if(base.timeout !== null)
        {
            clearTimeout(base.timeout);
        }

        base.timeout = setTimeout(function () {
            base.changeQty(itemId);
        }, base.delay);
    },

    minusQty: function(itemId){
        var base = this;
        var $qty = $('.sb-quantity-'+itemId);
        var newQty = parseInt($qty.val()) - 1;

        if(newQty < 1) return;

        $qty.val(newQty);

        base.queue(itemId);

    },

    plusQty: function(itemId){
        var base = this;
        var $qty = $('.sb-quantity-'+itemId);
        var newQty = parseInt($qty.val()) + 1;

        $qty.val(newQty);

        base.queue(itemId);

    },

    changeQty: function(itemId){
        var base = this;
        var $qty = $('.sb-quantity-'+itemId);
        var newQty = $qty.val();

        if(newQty === 0 || newQty === '')
        {
            newQty = 1;
            $qty.val(1);
        }

        var params = {};
        params.controller = 'webshopController';
        params.method = 'changeBasketItemQuantity';

        params.itemId = itemId;
        params.quantity = newQty;

        base.action = $.ajax({
            type: 'POST',
            url: '',
            dataType: 'json',
            data: params,
            success: function (data) {
                if (data.success) {
                    $('#shoppingBagContainer').html(data.table);
                    Basket.refresh(data.itemsCount);
                }

            },
            beforeSend: function(){
                base.showLoader();
            },
            complete: function(){
                base.hideLoader();
                base.timeout = null;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR + '   |   ' + textStatus + '   |   ' + errorThrown);
            }
        });

    },

    removeItem: function(itemId){
        var base = this;

        var params = {};
        params.controller = 'webshopController';
        params.method = 'removeBasketItem';
        params.itemId = itemId;

        base.action = $.ajax({
            type: 'POST',
            url: '',
            dataType: 'json',
            data: params,
            success: function (data) {
                if (data.success) {
                    $('#shoppingbag-table').html(data.table);

                    if(data.itemsCount == 0){
                        $('.main-action-button').hide();
                    }

                    Basket.refresh(data.itemsCount);
                }

            },
            beforeSend: function(){
                base.showLoader();
            },
            complete: function(){
                base.hideLoader();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR + '   |   ' + textStatus + '   |   ' + errorThrown);
            }
        });
    },

    createOrder: function(){
        var base = this;

        if(!$('.payment-methods li input:checked').length)
        {
            alert('Select payment method, please');
            return;
        }

        var params = {};
        params.controller = 'webshopController';
        params.method = 'createOrder';
        params.paymentMethod = $('.payment-methods li input:checked').val();

        base.action = $.ajax({
            type: 'POST',
            url: '',
            dataType: 'json',
            data: params,
            success: function (data) {
                if (data.success) {
                    //window.location.href = data.url;
                    $('body').after(data.html);
                    document.getElementById("directpayment").submit();
                }

            },
            beforeSend: function(){
                $('a.my-account-button').hide();
                $('.preloader').show();
            },
            complete: function(){
                $('.preloader').hide();
                $('a.my-account-button').show();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR + '   |   ' + textStatus + '   |   ' + errorThrown);
            }
        });
    }

}
