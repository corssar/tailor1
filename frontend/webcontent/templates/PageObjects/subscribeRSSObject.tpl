<div class="join-and-follow minimized">
    <a class="join-and-follow-header" href="#">{$webtext_joinOurTxt}{*JOIN OUR *}<span class="newsletter-text">{$webtext_newsLetterTxt}{*NEWSLETTER*}</span>
    </a>
    <p class="join-block-text">{$text}</p>
    <div class="join-block">
        <form id="subscribeRSSForm" method="post" action="">
            <input type="text" id="emailInputId"  placeholder="Your email" class="mail-input validate[required,custom[emailFormat]]" />
            <a href="#" onclick="subscribe2rss();return false;" class="join-button brown">{$webtext_joinSubscribeRSSButton}{*JOIN*}</a>
        </form>
    </div>
    <div class="horizontal-line brown">
    </div>
    <div class="followUs-block">
        FOLLOW US
        <div class="social-button facebook">
        </div>
        <div class="social-button twitter">
        </div>
        <div class="social-button google">
        </div>
    </div>
    <div class="copyright">
        &#169; AREFEVA, 2013
    </div>
</div>
<script type="text/javascript">
    $('.join-and-follow-header').click(function () { var toogleBlock = $('.join-and-follow'); if (toogleBlock.hasClass('minimized')) toogleBlock.removeClass('minimized'); else toogleBlock.addClass('minimized');});
    $(document).ready(function(){
        $('#subscribeRSSForm').validationEngine();
    });
    var validationSubscribeRSSText ='{$webtext_emailInputTxt}{*Email incorrect*}';
</script>