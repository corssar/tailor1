<?php
/*require_once(FRAMEWORK_PATH."system/Event/Event.php");*/
include_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");

class EventField
{
    public function eventList($id, $params = array())
    {
        $result = array();

        if($params['posted'])
        {
            $query = "UPDATE be_MailTemplates SET eventId = '{$params['eventId']}' WHERE id = '$id'";
            Context::DB()->query($query);
        }
        else
        {
            $view = new SmartyView();
            $arrayData = array();

            $query = "SELECT eventId FROM be_MailTemplates WHERE id = '$id'";
            Context::DB()->query($query);
            $eventId = Context::DB()->result[0]['eventId'];

            $arrayData['selected'] = $eventId;
            $arrayData['events'] = $this->getEvents();
            $html = $view->fetch(BACKEND_PATH.'templates/eventField.tpl', $arrayData);

            $result['html'] = $html;
            $result['js'] = 'javascript:showEventMasks();$(":input").focus(function(){fieldId = this.id;});';
        }

        return $result;
    }

    private function getEvents()
    {
        $cache = new CacheFace();
        if(($data = $cache->get('event_list')) !== false) return unserialize($data);

        $query = "SELECT id, code, name, class FROM be_Events ORDER BY name";

        $events = array();
        if (Context::DB()->query($query))
        {
            foreach(Context::DB()->result as $event)
            {
                $object = new $event['class']();
                $masks = array();
                foreach($object->getEventMasks() as $maskObj)
                {
                    $mask['groupFields'] = $maskObj->getMask();
                    $mask['groupName'] = $maskObj->getMaskName();
                    $masks[] =  $mask;
                }
                $event['masks'] = $masks;

                $events[] = $event;
            }
        }

        $cache->save(serialize($events));
        return $events;
    }

    public function testSend($id, $params = array())
    {
        $view = new SmartyView();
        $session 	= new SESSION();
        $admin		= new ADMIN($session);

        $arrayData = array();
        $arrayData['adminEmail'] = $admin->email;

        $html = $view->fetch(BACKEND_PATH.'templates/sendEventField.tpl', $arrayData);

        $result['html'] = $html;
        $result['js'] = '$(".sendTestMail").click(function(){sendTestMail();});';

        return $result;
    }
}
