<?php

class Role
{
    function __construct()
    {
        $this->db = Context::DB();
    }

    public function websiteAdminRelation($id, $params = array())
    {
        $html = "";
        if(isset($params['posted']) && $params['posted'])
        {
            $this->db->query("DELETE FROM tbl_Menu_Roles WHERE roleId = $id");

            unset($params['posted']);
            $q = "INSERT INTO tbl_Menu_Roles (roleId, menuId) ";
            $index = 0;
            foreach($params as $param)
            {
                $q .= $index != 0 ? ", ('$id','$param')" : "VALUES('$id','$param')";

                $index++;
            }

            $this->db->query($q);
        }
        else
        {
            $menuIds = array();
            if($id != null)
            {
                $q = "SELECT menuId FROM tbl_Menu_Roles WHERE roleId = '$id'";
                $this->db->query($q);
                $menuIds = $this->db->result;
            }

            $html .= "<div class='menuRoles'>";
            $menu = new MenuNavigation();
            $menu->buildMenu(true);
            $menuItems = $menu->menuNavigation;
            foreach($menuItems as $menuParent)
            {
                $checked = "";
                foreach($menuIds as $menuId)
                {
                    if($menuParent['id'] == $menuId['menuId'])
                        $checked = "checked='checked'";
                }

                $html .= "<div class='parent'>";
                $html .= "<input type='checkbox' name='customField[" . $menuParent['id'] . "]' $checked value='" . $menuParent['id'] ."'/>";
                $html .= "<span>" . $menuParent['title'] . "</span>";
                foreach($menuParent['child'] as $child)
                {
                    $checked = "";
                    foreach($menuIds as $menuId)
                    {
                        if($child['id'] == $menuId['menuId'])
                            $checked = "checked='checked'";
                    }
                    $html .= "<div class='child'>";
                    $html .= "<input type='checkbox' name='customField[" . $child['id'] . "]' $checked value='" . $child['id'] ."'/>";
                    $html .= "<span>" . $child['title'] . "</span>";
                    $html .= "</div>";
                }
                $html .= "</div>";
            }
            $html.= '</div>';
            $html.= '<input type="hidden" name="customField[posted]" value="1">';

        }
        return $html;
    }
}
?>