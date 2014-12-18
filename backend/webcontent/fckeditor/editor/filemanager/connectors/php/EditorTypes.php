<?php
require_once ('../../../../../../../config.php');

class EditorTypes
{
    public function getTypes()
    {
        $userTypes = array('File' => 'File',
                           'Image' => 'Image',
                           'Video' => 'Video',
                           'Audio' => 'Audio',
                           'CSS' => 'CSS',
                           'JavaScript' => 'JavaScript',
                           'Templates' => 'Templates',);

        $adminTypes = array('File' => 'File',
                            'Image' => 'Image',
                            'Video' => 'Video',
                            'Audio' => 'Audio',
                            'CSS' => 'CSS',
                            'JavaScript' => 'JavaScript',
                            'Templates' => 'Templates',
                            'Websites' => 'Websites');

        require_once(BACKEND_PATH.'libs/Admin.php');
        require_once(BACKEND_PATH.'libs/Session.php');

        $session 	= new SESSION();
        $admin		= new ADMIN($session);

        $types = $userTypes;
        $toRet = "var aTypes = [";
        $index = 0;
        foreach($types as $key => $type)
        {
            $toRet .= "['$key','$type'],";
            $index++;
        }

        if($admin->isAccess == '1')
        {
            $toRet .= "['Websites','Websites'],";
        }

        $toRet = substr($toRet, 0, -1);

        $toRet .= "];";

        return $toRet;
    }
}

$editorType = new EditorTypes();
echo $editorType->getTypes();
