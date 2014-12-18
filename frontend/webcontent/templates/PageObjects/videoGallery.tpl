{if count($videos)>0}
    <div class="clear"></div>
    <div class="spec_hr"></div>
    <div id="town-photos">
        <h2>{$webtext_videos}{*Β³δεξ*}</h2>
        <div class="g-navigation">
            <ul class="thumbs">
                {foreach item=video from=$videos}
                    <li>
                        <a href="javascript:void(0)" onclick="$('#popup_reference').toggleVideoPopup('{$video.video}');return false;">
                            <img width="170" height="128" src="{$video.imagePreview}" alt="" />
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/if}
<div class="clear"></div>
{literal}
<script type="text/javascript">
    var yTplayerWidth	=	640;
    var yTplayerHeight	=	480;

    function loadVideo(videoId){
        $('#youtubePlayerContainer').empty().html('<iframe type="text/html" ' +
                'width="'+yTplayerWidth+'" ' +
                'height="'+yTplayerHeight+'" ' +
                'src="http://www.youtube.com/embed/'+videoId+'" ' +
                'frameborder="0" ' +
                'wmode="Opaque">' +
                '</iframe>');
    }
    function stopVideo()
    {
        $('#youtubePlayerContainer').empty();
    }

    $(document).ready(function(){
        $.fn.alignCenter = function() {
            var marginLeft =  - $(this).width()/2 + 'px';
            var marginTop =  - $(this).height()/2 + 'px';
            return $(this).css({'margin-left':marginLeft, 'margin-top':marginTop});
        };
        $.fn.toggleVideoPopup = function(videoId){
            if($('#popup').hasClass('hidden'))
            {
                if($.browser.msie)
                {
                    $('#opaco').height($(document).height()).toggleClass('hidden')
                            .click(function(){$(this).toggleVideoPopup();});
                }
                else
                {
                    $('#opaco').height($(document).height()).toggleClass('hidden').fadeTo('slow', 0.8)
                            .click(function(){$(this).toggleVideoPopup();});
                }
                $('#popup')
                        .html($(this).html())
                        .alignCenter().slideToggle()
                        .toggleClass('hidden');
                loadVideo(videoId);
            }
            else
            {
                $('#opaco').toggleClass('hidden').removeAttr('style').unbind('click');
                stopVideo();
                $('#popup').slideToggle().toggleClass('hidden');
            }
        };
    });

</script>
{/literal}