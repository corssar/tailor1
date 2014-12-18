<div class="homePageBlock">
<div class="mainBlockBody">
    <h1>{$title}</h1>
    <p>{$introHtml}</p>

{foreach key=id item=vacancyItem from=$vacancy_list}
    <div class="vacancyBlockRow">
        <a href="{$vacancyItem.URL}">
            <div class="newTitle"><span>{$vacancyItem.title}</span></div>
        </a>

        <div class="newDescription"><span>{$vacancyItem.shortDescription}</span></div>
        <div class="newDate"><span>{$vacancyItem.date}</span></div>
    </div>
</div>
{/foreach}

    <div class="mainBlockBottomButton">{$paging}</div>
</div>
<div class="mainBlockBottom"></div>
</div>