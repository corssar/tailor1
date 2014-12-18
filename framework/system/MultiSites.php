<?php

class MultiSites
{
    public static function GetSitesSelect()
    {
        $selectHtml = "<select id='multiSiteSelect' onchange='javascript:ChangeWebsiteId();'>";

        $session 	= new SESSION();
        $admin		= new ADMIN($session);
        $adminId =  $admin->id;
        $query = "SELECT websiteId
                      FROM
                        tbl_Website_Admin
                      WHERE
                        adminId = '" . $adminId . "'";

        if (!Context::DB()->query($query))
            return false;

        $websiteIds = Context::DB()->result;
        $websiteIdInRoles = " where id in (";
        $index = 0;
        foreach($websiteIds as $websiteId)
        {
            $websiteIdInRoles .= $index == 0 ? "'{$websiteId['websiteId']}'" : ", '{$websiteId['websiteId']}'";
            $index++;
        }
        $websiteIdInRoles .= ")";

        $query = "select id, name from be_WebSites $websiteIdInRoles";
        Context::DB()->query($query);
        foreach(Context::DB()->result as $result)
        {
            $selected = $result['id'] === Context::SiteSettings()->getSiteIdFromSession()
                          ? "selected='selected'"
                          : "";

            $selectHtml .= "<option value='" . $result['id'] . "' " . $selected . ">" . $result['name'] . "</option>";
        }

        $selectHtml .= "</select>";

        return $selectHtml;
    }
}
