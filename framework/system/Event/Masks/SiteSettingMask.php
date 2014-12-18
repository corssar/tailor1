<?php

class SiteSettingMask extends EventMask
{
    public function getMask()
    {
        return array("{SITE_NAME}"=> WebText::getText("SITE_SETTING_MASKS_SITE_NAME", "��'� �����"),
                     "{SITE_ID}" => WebText::getText("SITE_SETTING_MASKS_SITE_ID", "Id �����"),
                     "{SITE_ADMIN_EMAIL}" => WebText::getText("SITE_SETTING_MASKS_SITE_ADMIN_EMAIL", "Email �������������� �����"));
    }

    public function replaceMask()
    {
        return array("{SITE_NAME}"=> Context::SiteSettings()->getSiteName(),
                     "{SITE_ID}" => Context::SiteSettings()->getSiteId(),
                     "{SITE_ADMIN_EMAIL}" => Context::SiteSettings()->getDefaultSiteEmail());
    }

    public function getMaskName()
    {
        return WebText::getText("site_setting_mask_group_name", "����");
    }
}