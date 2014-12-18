<?php
include_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");

class Shop
{
    public $fieldId;
    public $viewId;
    public $fieldName;
    public $additionalParams = array();

    public function ShippingBillingAddress($id, $params = array())
    {
        $result = array();

        return $result;

        if(isset($id) && $id)
        {
            $result['html'] = '';
            $result['js'] = '';
            return $result;
        }

        $view = new SmartyView();
        $templateData = array();

        $attributes = array();
        $query = "  SELECT
                        *
                    FROM
                        fe_Addresses
                    ";
        if(Context::DB()->query($query))
        {
            foreach(Context::DB()->result as $attribute)
            {

            }
        }

        $templateData['attributes'] = $attributes;
        $templateData['productViewId'] = $this->viewId;
        $html = $view->fetch(BACKEND_PATH.'templates/productAttributes.tpl', $templateData);

        $result['html'] = $html;
        $result['js'] = '';

        return $result;
    }

    public function orderHistory($id, $params = array())
    {
        $result = array();
        $result['html'] = "<div class='orderHistoryContainer'>";
        $result['html'].= "<table><tr>";

        $result['html'].= "<th>Date</th>";
        $result['html'].= "<th>Admin</th>";
        $result['html'].= "<th>Order status</th>";
        $result['html'].= "<th>Payment status</th>";
        $result['html'].= "<th>Note</th>";

        $result['html'].= "</tr>";

        $query = "  SELECT
                        fe_OrderStatusHistory.*,
	                    be_Admin.username,
	                    fe_OrderStatus.description orderStatusName,
	                    fe_PaymentStatus.description paymentStatusName
                    FROM fe_OrderStatusHistory
                    INNER JOIN fe_OrderStatus ON fe_OrderStatus.id = fe_OrderStatusHistory.statusId
                    LEFT JOIN fe_PaymentStatus ON fe_PaymentStatus.id = fe_OrderStatusHistory.paymentStatusId
                    LEFT JOIN be_Admin ON be_Admin.id = fe_OrderStatusHistory.adminId
                    WHERE fe_OrderStatusHistory.orderId = '$id' ORDER BY fe_OrderStatusHistory.id";

        Context::DB()->query($query);
        foreach(Context::DB()->result as $item)
        {
            $result['html'].= "<tr>";

            $result['html'].= "<td>".$item['date']."</td>";
            $result['html'].= "<td>".$item['username']."</td>";
            $result['html'].= "<td>".$item['orderStatusName']."</td>";
            $result['html'].= "<td>".$item['paymentStatusName']."</td>";
            $result['html'].= "<td>".$item['note']."</td>";

            $result['html'].= "</tr>";
        }
        $result['html'] .= "</table>";
        $result['html'] .= "</div>";

        return $result;
    }
}