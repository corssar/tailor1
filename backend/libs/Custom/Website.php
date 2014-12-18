<?php

class Website
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
            $this->db->query("DELETE FROM tbl_Website_Admin WHERE adminId = $id");

            unset($params['posted']);
            $q = "INSERT INTO tbl_Website_Admin (adminId, websiteId) ";
            $index = 0;
            foreach($params as $key=>$param)
            {
                $site = explode('_', $key);
                if($site[0] == 'website')
                {
                    $q .= $index != 0 ? ", ('$id','$param')" : "VALUES('$id','$param')";
                    $index++;
                }
            }

            $this->db->query($q);
        }
        else
        {
            $websiteIds = array();
            if($id != null)
            {
                $q = "SELECT websiteId FROM tbl_Website_Admin WHERE adminId = '$id'";
                $this->db->query($q);
                $websiteIds = $this->db->result;
            }

            $html .= "<div class='menuRoles'>";

            $q = "SELECT * FROM be_WebSites";
            $this->db->query($q);
            foreach($this->db->result as $result)
            {
                $checked = "";
                foreach($websiteIds as $menuId)
                {
                    if($result['id'] == $menuId['websiteId'])
                        $checked = "checked='checked'";
                }

                $html .="<div class='websiteRole'>";
                $html .= "<input type='checkbox' name='customField[website_" . $result['id'] . "]' $checked value='" . $result['id'] ."'/>";
                $html .= "<span>" . $result['name'] . "</span>";
                $html .= "</div>";
            }

            $html.= '</div>';
            $html.= '<input type="hidden" name="customField[posted]" value="1">';
        }
        return $html;
    }
}
?>