$(document).ready(function(){
    $('.btnShowDeteils').click(function(){
        $(this).next().next('div').toggle(function(){
            $(this).css('display','block');
        },function(){
            $(this).css('display','hide');
        });
    });
});