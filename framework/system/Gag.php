<?php
include_once(FRAMEWORK_PATH.'system/tpl_engine/SmartyView.php');

class Gag
{
    public function show()
    {
        $view = new SmartyView();
        $data['title'] = Context::SiteSettings()->getGagTitle();
        $data['html'] = Context::SiteSettings()->getGagHtml();

        $pageHTML = $view->fetch(FRONTEND_TEMPL_PATH."MasterPages/GagTemplate.tpl",$data);
        echo $pageHTML;
    }

    public function check()
    {
        if(!Context::SiteSettings()->isGag() || strpos($_SERVER['REQUEST_URI'], "/backend"))
            return;

        $IPs = Context::SiteSettings()->getGagIPs();
        if(!empty($IPs))
        {
            foreach(explode(";", $IPs) as $ip)
            {
                if($_SERVER["REMOTE_ADDR"] == $ip)
                    return;
            }
        }

        $this->show();
        exit();
    }
}

$gag = new Gag();
$gag->check();