<style>
    .headerCenter {
        -webkit-box-shadow: 0px -10px 8px 0px rgba(50, 50, 50, 0.25);
        -moz-box-shadow: 0px -10px 8px 0px rgba(50, 50, 50, 0.25);
        box-shadow: 0px -10px 8px 0px rgba(50, 50, 50, 0.25);
    }
</style>
{literal}
<script type="text/javascript">
    var countOnPage = '{/literal}{$countOnPage}{literal}';
    var totalPages = '{/literal}{$totalPages}{literal}';
    var sort = '{/literal}{$sort}{literal}';
    var sortType = '{/literal}{$sortType}{literal}';
    var sfKeyWord = '{/literal}{$sfKeyWord}{literal}';
    var langId = '{/literal}{$langId}{literal}';
    u = new Url;
</script>
{/literal}
<div class="categoryHeaderHolder">
    <div class="categoryHeader">
        <div class="hide-onpagescroll">
            <div class="hr"></div>
            {if empty($noSearchResult)}
                <div class="search-header-text">{$webtext_searchResult}{*Search results*} <b>"{$smarty.get.sfKeyWord}"</b> {$webtext_findWide}{*found*} <b>{$searchCountItems}</b> {$webtext_pagesWide}{*page (pages)*}</div>
        </div>
                <div class="hr"></div>
                <div class="filter-container">
                    <b>{webtext keyword='product_sort_by' value='SORT BY:'}</b>
                    <span id="btn-catalog-select">
                        <button class="btn-product-brand btn_down_icon{if $sort eq "brand" && $sortType eq "ASC"} btn_active_down_icon{elseif $sort eq "brand" && $sortType eq "DESC"} btn_active_up_icon {/if}" value="brand" >Brand</button>
                        <button class="btn-product-price btn_down_icon{if $sort eq "price" && $sortType eq "ASC"} btn_active_down_icon{elseif $sort eq "price" && $sortType eq "DESC"} btn_active_up_icon {/if}" value ="price">Price</button>
                        <button class="btn-product-name btn_down_icon{if $sort eq "name" && $sortType eq "ASC"} btn_active_down_icon{elseif $sort eq "name" && $sortType eq "DESC"} btn_active_up_icon {/if}" value ="name">Name</button>
                    </span>
                 </div>
            {else}
                <div class="search-header-text">{$webtext_searchResult}{*Search results*} <b>"{$smarty.get.sfKeyWord}"</b> {$webtext_NotfindWide}{*not found*} {$webtext_pagesWide}{*page (pages)*}</div>
                <div class="hr searchHr"></div>
            {/if}
     </div>
</div>
    <div class="pageContent">
        {include file='./viewproducts.tpl'}
        <div id="preloader"><img src="{$smarty.const.SITE_PROTOCOL}{$smarty.const.SITE_URL}/frontend/webcontent/system_images/ajax-loader.gif" /></div>
    </div>
<script type="text/javascript">
    $(window).scroll(function () {
        if ($(window).scrollTop())
            $(".page-content").addClass("scrolled");
        else
            $(".page-content").removeClass("scrolled");

        if  ($(window).scrollTop() == $(document).height() - $(window).height())
        {
            if (loadingNextPage == true){
                return;
            }
            if(u.query.page===undefined || u.query.page==0 ){
                if (totalPages != ''){
                    history.pushState(null, null, '?page=1' +'&sfKeyWord='+ sfKeyWord);
                }else{
                    history.pushState(null, null, '');
                }
            }
                u=new Url;
                u.query.page++;
            if (u.query.page <= totalPages){
                showHidePreloader(true);
                addSearchScrollPaging();
            }
        }

    });

    $("#btn-catalog-select button").click(function(){
        var m =$(this).val();
        $(this).siblings().removeClass('btn_active_down_icon');
        $(this).siblings().removeClass('btn_active_up_icon');
        u = new Url;
        if ( $("#btn-catalog-select button").hasClass("btn_active_down_icon")){
            $(this).removeClass('btn_active_down_icon');
            $(this).addClass('btn_active_up_icon');
            u.query.sort=m;
            u.query.type='DESC';
            window.location.href = u;
        }else  if ( $("#btn-catalog-select button").hasClass("btn_active_up_icon")){
            $(this).removeClass('btn_active_down_icon');
            delete u.query.sort;
            delete u.query.type;
            window.location.href = u;
        }else{
            $(this).addClass('btn_active_down_icon');
            u.query.sort=m;
            u.query.type='ASC';
            window.location.href = u;
        }

    });

</script>