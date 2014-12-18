<div class="frame-crumbs">
    <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        <div class="container">
            <ul class="items items-crumbs" itemtype="http://schema.org/BreadcrumbList">
                <li class="btn-crumb" itemprop="itemListElement" itemscope
                    itemtype="http://schema.org/ListItem"
                    itemprop="url">
                    <a href="/" typeof="v:Breadcrumb" itemprop="item">
                        <span class="text-el" itemprop="name">{webtext keyword='home-page' value='Главная страница' remark='breadcrumbs'}<span class="divider">&#8594;</span></span>
                    </a>
                </li>
                {breadcrumb nodes=$menuItems}
{*                {foreach item=node from=$nodes name=nodesList}
                    <li class="btn-crumb">
                        <a href="{$node.link}" typeof="v:Breadcrumb">
                            <span class="text-el"><span class="divider">&#8594;</span></span>
                        </a>
                    </li>
                {/foreach}*}
{*
                <li class="btn-crumb">
                    <a href="http://demoshop.imagecms.net/" typeof="v:Breadcrumb">
                        <span class="text-el">Home<span class="divider">&#8594;</span></span>
                    </a>
                </li>
                <li class="btn-crumb" typeof="v:Breadcrumb">
                    <a href="http://demoshop.imagecms.net/shop/category/telefoniia-pleery-gps" rel="v:url"
                       property="v:title">
                        <span class="text-el">Zap<span class="divider">&#8594;</span></span>
                    </a>
                </li>
                <li class="btn-crumb" typeof="v:Breadcrumb">
                    <a href="http://demoshop.imagecms.net/shop/category/telefoniia-pleery-gps/telefony" rel="v:url"
                       property="v:title">
                        <span class="text-el">Mot<span class="divider">&#8594;</span></span>
                    </a>
                </li>
                <li class="btn-crumb" typeof="v:Breadcrumb">
                    <button rel="v:url" property="v:title" disabled="disabled">
                        <span class="text-el">End</span>
                    </button>
                </li>*}
            </ul>
        </div>
    </div>
</div>