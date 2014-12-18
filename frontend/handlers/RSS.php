<?php
    require_once '../../config.php';
    require_once(FRAMEWORK_PATH."system/Context.php");
    require_once(FRAMEWORK_PATH."system/WebText.php");
    require_once(FRAMEWORK_PATH."data_objects/NewsListData.php");
    include_once(FRAMEWORK_PATH."system/CMSException.php");

    header('Content-type: application/rss+xml');

    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss></rss>');
    $xml->addAttribute('version','2.0');
    $channel = $xml->addChild('channel');
    $channel->addChild('title', WebText::getText("rssTitle","BYD RSS"));
    $channel->addChild('link', SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/');

    try{
       BuildRssItems($channel);
    }
    catch (PageNotFoundException $e){
    }

    print($xml->asXML());

    function BuildRssItems($channel)
    {
        if(Request::getString("lang", "GET") === null) return;

        $langCode = Context::LanguageCode();
        $Languages = &Languages::getInstance();

        $news = new NewsListData($Languages->GetLangIdByCode($langCode));
        $newsList = $news->getNewsContent();

        if(!isset($newsList)) return;

        foreach ($newsList as $newsItem)
        {
            $item = $channel->addChild('item');
            $item->addChild('title', $newsItem['title']);
            $item->addChild('description', $newsItem['shortDescription']);
            $item->addChild('link', $newsItem['URL']);
            $item->addChild('pubDate', $newsItem['dateRSS']);
        }
    }
?>