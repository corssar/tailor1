<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="uk" />
    <meta name="Author" content="IproAction Develop team" />
    <title>{$subject}</title>
</head>
<body style="font-size:12px;font-family:arial;margin-top:20px;line-height:1.5;">
<div style="width:710px;margin: 0 auto;">
    <div style="width:560px;padding: 0 75px;background:url({$logoImg}) no-repeat;height:145px;">
        {if strlen($title)>0}<h1 style="font-size:21px;font-weight:bold;color:#2B92E8;float:right; margin:85px 0 0;">{$title}</h1>{/if}
    </div>
    <div style="width:560px;margin:0 auto;font-size:14px;color:#333333;">
        {$body}
    </div>
    <div style="width:560px;margin:20px auto 0">
        {if strlen($subscribe)>0}<h2 style="margin:10px 10px 0 0;font-size:18px;color:#333333;float:left;">{$subscribe}</h2>{/if}
        <img src='{$footerImg}' />
    </div>
</div>
</body>
</html>