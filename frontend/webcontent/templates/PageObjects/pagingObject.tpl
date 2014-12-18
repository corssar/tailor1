<div class="pagination">
{if $pagesCount != 1}
    <ul>
        {if $currentPage != 1}
            <li>
                <a class="leftPage" href="{$handler}">{$webtext_paging_first_page1}{*<<*}</a>
            </li>
            <li>
                <a class="leftPage" href="{$handler}{if $currentPage != 2}{$tag}page={$currentPage - 1}{/if}">{$webtext_paging_prev_page1}{*<*}</a>
            </li>
        {/if}

        {for $foo=$startPaginingPage to $endPaginingPage}
            <li class="{if $currentPage eq $foo}active{/if}">
                {if $currentPage eq $foo}
                    <span>{$foo}</span>
                {else}
                    <a href="{$handler}{if $foo != 1}{$tag}page={$foo}{/if}">{$foo}</a>
                {/if}
            </li>
        {/for}

        {if $currentPage != $pagesCount && $pagesCount != 0}
            <li>
                <a class="rightPage" href="{$handler}{$tag}page={$currentPage + 1}">{$webtext_paging_next_page1}{*>*}</a>
            </li>
            <li>
                <a class="rightPage" href="{$handler}{$tag}page={$pagesCount}">{$webtext_paging_end_page1}{*>>*}</a>
            </li>
        {/if}
    </ul>
{/if}
</div>