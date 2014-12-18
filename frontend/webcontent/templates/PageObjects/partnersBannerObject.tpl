<div class="clear"></div>
<div class="partners">
    <h2>{$webtext_homePagePartners}{*Партнери*}</h2>
    <div class="pheight">
    {foreach item=partner from=$partnersList}
        <a href="{$partner.link}" class="partnerHomeBlock">
            <img src="{$partner.logo}" alt="" title="{$partner.title}" />
        </a>
    {/foreach}
        <div class="clear"></div>
    </div>
</div>