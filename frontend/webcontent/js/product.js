$(document).ready(function ()
{
    $(".product_info_small_images img").click(function() {
        var image_url = $(this).attr("data-url");
        var Bigimage_url = $(this).attr("data-url-bigImage");
        $('img#product_item_photo').attr({'src':  image_url});
        $('a.cloud-zoom').attr({'href':  Bigimage_url});
        if ($('div.mousetrap'))
        {
            $('div.mousetrap').remove();
        }
        $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
    });

    $('.productListBuyButton').click(function(event){
        event.preventDefault();
        Basket.add(this);
    });
});


