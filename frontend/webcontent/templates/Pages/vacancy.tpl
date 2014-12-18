<div class="homePageBlock">
    <div class="mainBlockTop"></div>
    <div class="mainBlockBody">
        <h1>
        {$title}
            <p>{$date}</p>

        </h1>
        <div class="vacancyHtml">{$html}</div>
        <br>
    {section name=i loop=$photos}
        <br>
        <p align = "center"><img src="{$photos[i].URL}" width="500" height="375" alt="Vacancy" </p>
        </br>
    {/section}
        </br>
    </div>
</div>