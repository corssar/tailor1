<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="{$metaLanguageTag}" />
    <meta name="Author" content="IproAction Develop team" />
    <meta name="Reply-to" content="ipa.develop.team@gmail.com" />
    <meta http-equiv="Expires" content="Tue, 20 Aug 1996 14:25:27 GMT" />
    {$pageHeaderMETA}
    <link rel="icon" href="{$smarty.const.SITE_PROTOCOL}{$siteUrl}/favicon.ico" type="image/x-icon" />
    {$pageHeaderHTML}
    {if (count( $aAreasHTML[9] ) > 0 )}
        {foreach from=$aAreasHTML[9] item=curr_PO_HTML key=key}
            {$curr_PO_HTML}
        {/foreach}
    {/if}
    {*Google analytics code*}
    {*Google analytics code*}
    {if (strlen($smarty.const.GA_CODE)>0 and $smarty.const.GA_CODE != 'GA_CODE')}
    {literal}
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '{/literal}{$smarty.const.GA_CODE}{literal}']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
            function plusone_vote(obj) {
                _gaq.push(['_trackEvent','plusone',obj.state]);
            }
        </script>
    {/literal}
    {/if}
    {$pageHeaderJS}
    {$pageHeaderCSS}
</head>
<body>
<div id="body">
    <div id="header">
        <div id="lockAll"><!--  --></div>
        {if (count( $aAreasHTML[1] ) > 0 )}
            <div class="header_menu">
                <div class="shell">
                    {foreach from=$aAreasHTML[1] item=curr_PO_HTML key=key}
                        {$curr_PO_HTML}
                    {/foreach}
                </div>
            </div>
        {/if}
        {if (count( $aAreasHTML[2] ) > 0 )}
            <div class="headerCenter">
                <div class="shell">
                    {foreach name=area2 from=$aAreasHTML[2] item=curr_PO_HTML key=key}
                        {$curr_PO_HTML}
                    {/foreach}
                </div>
            </div>
        {/if}
        {if (count( $aAreasHTML[3] ) > 0 )}
            <div class="header_bottom">
                {foreach from=$aAreasHTML[3] item=curr_PO_HTML key=key}
                    {$curr_PO_HTML}
                {/foreach}
            </div>
        {/if}
    </div>
    <div id="content">
        {if (count( $aAreasHTML[4] ) > 0 )}
                {foreach from=$aAreasHTML[4] item=curr_PO_HTML key=key}
                    {$curr_PO_HTML}
                {/foreach}
        {/if}
        <div id="contentCenter">
            {$pageHTML}
        </div>
        {if count($aAreasHTML[5]) > 0}
            <div class="contentRight">
                {foreach from=$aAreasHTML[5] item=curr_PO_HTML key=key}
                    {$curr_PO_HTML}
                {/foreach}
            </div>
        {/if}
        {if (count( $aAreasHTML[6] ) > 0 )}
            <div class="">
                {foreach from=$aAreasHTML[6] item=curr_PO_HTML key=key}
                    {$curr_PO_HTML}
                {/foreach}
            </div>
        {/if}
    </div>
    <div id="footer">
        {if (count( $aAreasHTML[7] ) > 0 )}
            <div class="footer_menu">
                <div class="shell">
                    {foreach from=$aAreasHTML[7] item=curr_PO_HTML key=key}
                        {$curr_PO_HTML}
                    {/foreach}
                </div>
            </div>
        {/if}
        {if (count( $aAreasHTML[8] ) > 0 )}
            <div class="footer-bottom">
                <div class="shell">
                    {foreach from=$aAreasHTML[8] item=curr_PO_HTML key=key}
                        {$curr_PO_HTML}
                    {/foreach}
                </div>
            </div>
        {/if}
    </div>
</div>
</body>
</html>