<?php
include_once FRAMEWORK_PATH . "/system/appUrl.php";

class PaymentProvidersFactory
{
    public static function getProviderById($id)
    {
        $cache = new CacheFace();
        if($cacheData = $cache->get("paymentProvidersFactory_getProviderById_".$id))
            return unserialize($cacheData);

        $query = "SELECT p.id,
                p.title,
                p.className,
                p.merchantId,
                p.secretKey,
                p.hiddenKey,
                p.apiKey,
                p.successUrl,
                p.failUrl,
                p.resultUrl,
                i.listItemName as currency
                FROM fe_PaymentProviders p
                LEFT JOIN be_ListItems i ON i.id = p.currencyId
                WHERE p.websiteId = ".Context::SiteSettings()->getSiteId()."
                AND p.id = ".(int)$id;

        if (!Context::DB()->query($query))
            throw new CMSException("Can not get config of payment provider with id = ".$id);


        $provider = Context::DB()->result[0];
        $provider['successUrl'] = appUrl::checkUrl($provider['successUrl']);
        $provider['failUrl'] = appUrl::checkUrl($provider['failUrl']);
        $provider['resultUrl'] = appUrl::checkUrl($provider['resultUrl']);

        $cache->save(serialize($provider));

        return $provider;
    }

    public static function getMethods()
    {
        $cache = new CacheFace();
        if($cacheData = $cache->get("paymentProvidersFactory_getMethods"))
            return unserialize($cacheData);

        $query = "SELECT *
                  FROM fe_PaymentMethods
                  WHERE websiteId = ".Context::SiteSettings()->getSiteId()."
                  ORDER BY orderNumber";

        if (!Context::DB()->query($query))
            throw new CMSException("");

        $methods = Context::DB()->result;

        $cache->save(serialize($methods));
        return $methods;
    }

    public static function getMethodById($id)
    {
        $query = "SELECT *
                  FROM fe_PaymentMethods
                  WHERE websiteId = ".Context::SiteSettings()->getSiteId()." AND id = ".$id."
                  ORDER BY orderNumber";

        if (Context::DB()->query($query))
            return Context::DB()->result[0];

        return array();
    }
}