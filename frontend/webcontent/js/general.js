$(document).ready(function(){
    $('.first_menu_level').mouseover(function(){
        $(this).find('.second_menu_level').show();
    });

    $('.first_menu_level').mouseleave(function(){
        $('.second_menu_level').hide();
    });
});