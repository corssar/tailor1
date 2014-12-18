<?php
require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/helper/LinkManager.php");
require_once(FRAMEWORK_PATH."system/MailBus.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");

class EventManager
{
    public static function Execute($eventObject, $additionalParams = array())
    {
        //get event data from db or if not exist ib db, event data was generated
        $event = self::eventInitialize($eventObject);

        //get mail templates list for current event id
        $templates = self::getMailTemplates($event['id']);

        //get replaced data from all masks array and array marge with additional parameters
        $replacement = self::getReplacedMasksData($eventObject->getEventMasks(), $additionalParams);

        //replace all masks data in mail templates and send mails to recipients
        return self::mailReplaceAndSendProcess($event, $templates, $replacement);
    }

    private static function mailReplaceAndSendProcess($event, $templates, $replacement)
    {
        if($templates == -1)
        {
            Context::Log(true, 'Events')->log("Event mail template not found for event id: {$event['id']}");
            return false;
        }

        $returnValue = false;

        foreach ($templates as $mail)
        {
            $mail['subject'] = self::maskReplace($mail['subject'], $replacement);
            $mail['emails'] = self::maskReplace($mail['emails'], $replacement);
            $mail['bcc'] = self::maskReplace($mail['bcc'], $replacement);
            $HTML = self::maskReplace($mail['body'], $replacement);

            if($mail['seeAddresses'] == '1')
            {
                $returnValue = MailFace::SendHTMLMail($mail['subject'], Context::SiteSettings()->getDefaultSiteEmail(), $mail['emails'], $HTML, 'Sorry this mail has HTML body...', $mail['bcc']);
            }
            else
            {
                $emails = preg_split('/,/', $mail['emails'], -1, PREG_SPLIT_NO_EMPTY);
                if(count($emails) > 0)
                {
                    foreach($emails as $email)
                    {
                        $returnValue = MailFace::SendHTMLMail($mail['subject'], Context::SiteSettings()->getDefaultSiteEmail(), $email, $HTML, 'Sorry this mail has HTML body...', $mail['bcc']);
                    }
                }
            }
        }

        return $returnValue;
    }

    private static function getReplacedMasksData($maskObjects, $additionalParams)
    {
        $replacement = array();
        foreach($maskObjects as $maskObject)
        {
            $replacement = array_merge($replacement, $maskObject->replaceMask());
        }

        return array_merge($replacement, $additionalParams);
    }

    private static function eventInitialize($eventObject)
    {
        $eventCode = $eventObject->getEventCode();
        $eventClass = $eventObject->getEventClass();
        $eventName = $eventObject->getEventName();

        $event = null;
        $cache = new CacheFace();
        if(($data = $cache->get('event_' . $eventCode)) !== false)
        {
            $event = unserialize($data);
        }
        else
        {
            $query="SELECT id, name, code, class
	                FROM be_Events
	                WHERE code = '$eventCode'";

            if (Context::DB()->query($query))
            {
                $event = Context::DB()->result[0];
            }
            else
            {
                $query = "INSERT INTO be_Events(code, name, class)
			              VALUES('$eventCode', '$eventName', '$eventClass')";
                Context::DB()->query($query);
                $eventId = Context::DB()->LIID;
                $event['name'] = $eventName;
                $event['code'] = $eventCode;
                $event['class'] = $eventCode;
                $event['id'] = $eventId;
            }

            $cache->save(serialize($event));
        }

        return $event;
    }

    private static function getMailTemplates($eventId)
    {
        $mailList = null;
        $cache = new CacheFace();
        $cacheKey = "mail_template_collection_ {$eventId}_" . Context::LanguageId();
        if(($cacheData = $cache->get($cacheKey)) !== false)
        {
            $mailList = unserialize($cacheData);
        }
        else
        {
            $query = "SELECT *
                      FROM be_MailTemplates
                      WHERE eventId = '$eventId' AND langId = '" . Context::LanguageId() . "' AND active = '1' AND websiteId = '" . Context::SiteSettings()->getSiteId() . "'";
            if (Context::DB()->query($query))
            {
                $mailList = Context::DB()->result;
                $cache->save(serialize($mailList));
            }
        }

        if(!$mailList || ($mailList && !count($mailList)))
            return -1;//нема шаблонів листів для даного сайта

        return $mailList;
    }

    private static function maskReplace($field, $masks)
    {
        foreach($masks as $key => $mask)
        {
            $field = str_replace($key, $mask, $field);
        }

        return appUrl::CMSConstantsToValues($field);
    }
}