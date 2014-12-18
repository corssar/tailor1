{$html}
{literal}
<script>
    $(document).ready(function(){
        $(".rslides").responsiveSlides({
            nav      : true,
            prevText : "",
            nextText : "",
            pager    : true
        });
        $(".rslides1_nav.prev").append('<div></div>');
        $(".rslides1_nav.next").append('<div></div>');
    });
</script>
{/literal}