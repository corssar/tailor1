<?php
require_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");

class MenuNavigation
{
    public $menuNavigation = array();

    public function get($edit)
    {
        $menuIdInRoles = "";
        if(!$edit)
        {
            $session 	= new SESSION();
            $admin		= new ADMIN($session);
            $roleId =  $admin->roleId;

            $query = "SELECT menuId
                      FROM
                        tbl_Menu_Roles
                      WHERE
                        roleId = '" . $roleId . "'";

            if (!Context::DB()->query($query))
                return false;

            $menuIds = Context::DB()->result;
            $menuIdInRoles = " AND id in (";
            $index = 0;
            foreach($menuIds as $menuId)
            {
                $menuIdInRoles .= $index == 0 ? "'{$menuId['menuId']}'" : ", '{$menuId['menuId']}'";
                $index++;
            }
            $menuIdInRoles .= ")";
        }

        $query = "SELECT *
				  FROM
				    be_Navigation
				  WHERE
				    visible = 1
				   " . $menuIdInRoles . "
				  ORDER BY
				    orderNumber ASC,
					id ASC";

        if (!Context::DB()->query($query))
            return false;

        return Context::DB()->result;
    }

    public function buildMenu($edit = false)
    {
    	global $lang;
        $menuList = array();
        $menuElements = $this->get($edit);
        $menuItems = $this->getMenuElements('0', $menuElements);
        foreach($menuItems as $element)
        {
            $menuItems[$element['id']]['child'] = $this->getMenuElements($element['id'], $menuElements);
        }

        $viewObj = new SmartyView();
        $menuList['menuList'] = $this->menuNavigation = $menuItems;
        switch(!empty($_GET['action'])?$_GET['action']:'')
        {
            case 'contentmanager':
                $menuList['selected'] = '1';
                break;
            case 'products':
                $menuList['selected'] = '2';
                break;
            case 'filemanager':
                $menuList['selected'] = '4';
                break;
            case 'users':
                $menuList['selected'] = '3';
                break;
            case 'preferances':
                $menuList['selected'] = '5';
                break;
            case 'geopoimanager':
                $menuList['selected'] = '15';
                break;
            case 'modules':
                $menuList['selected'] = '53';
                break;
            default:
                $menuList['selected'] = '1';
                break;
        }
        if(Context::SiteSettings()->multiLanguage())
        {
        	$menuList['buildRelatedContentPopUp'] = $lang['RELATED_CONTENT'];
        	$menuList['relatedContentPopUpTitle'] = $lang['RELATED_CONTENT'];
        }
        $viewHtml = $viewObj->fetch(BACKEND_PATH."templates/buildMenuNavigation.tpl", $menuList);

        return $viewHtml;
    }

    public function getMenuElements($parentId, $menu)
    {
        $parents = array();
        foreach($menu as $menuItem)
        {
            if($menuItem['parentId'] == $parentId)
            {
                $parents[$menuItem['id']] = array('id' => $menuItem['id'],
                    'title' => $menuItem['title'],
                    'id' => $menuItem['id'],
                    'href' => $menuItem['link'],
                    'click' => $menuItem['click'],
                    'class' => !empty($_GET['action']) && $_GET['action'] == $menuItem['param1'] ? "current" : "");
            }
        }

        return $parents;
    }
}