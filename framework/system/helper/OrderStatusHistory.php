<?php
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");

class OrderStatusHistory
{
    public static function saveHistory($id, $statusId, $paymentStatusId, $isAdmin = false, $note = '')
    {
        $adminId = 0;
        if($isAdmin){
            include_once(BACKEND_PATH.'libs/Admin.php');
            include_once(BACKEND_PATH.'libs/Session.php');
            $session 	= new SESSION();
            $admin		= new ADMIN($session);
            $adminId = $admin->id;
        }

        $query = "INSERT INTO fe_OrderStatusHistory (orderId, adminId, statusId, paymentStatusId, note)
                     VALUES ($id, $adminId, $statusId, $paymentStatusId, '$note')";
        Context::DB()->query($query);

    }
}
