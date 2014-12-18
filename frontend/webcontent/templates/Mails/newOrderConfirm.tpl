<html>
{*
	Parameters list
	[customer] 		=> Array
    [orderId] 		=> value
    [totalPrice] 	=> value
    [orderStatusId] => value
    [orderItems] 	=> Array
*}
    <head>
        <meta http-equiv="Content-Language" content="uk, ru" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>StoneContract -> {$webtext_orderConfirmMailTitle}{*Уведомление о заказе*}</title>
	</head>
    <body>
	    <div class="main">
    	    <div style="float:left; width:100%;border: solid 1px #CCC;background-color:#E1E1E1;">
				<div class="customer_detail">
					<div class="title">{$webtext_customerDetail}{*Реквизиты заказчика*}</div>
					<div class="item">{$customer.name} {$customer.surname}</div>
					<div class="item">{$customer.city}</div>
					<div class="item">{$customer.address}</div>
					<div class="item">{$webtext_tel}{*тел.*}:&nbsp;{$customer.phone}</div>
					<div class="item">Email:&nbsp;{$customer.email}</div>
				</div>
				<h2 class="payment_subtitle">{$webtext_payment_subtitle}{*Ваш заказ*}</h2>
				<table class="orderTable">
					<tr class="payment_table_header">
						<td class="basket_td5" style="border-top:1px solid #D7D1CC; border-bottom:1px solid #D7D1CC">{$webtext_productName}{*Наименование*}</td>
						<td class="basket_td6" style="border-top:1px solid #D7D1CC; border-bottom:1px solid #D7D1CC">{$webtext_count}{*Количество*}</td>
						<td class="basket_td6" style="border-top:1px solid #D7D1CC; border-bottom:1px solid #D7D1CC">{$webtext_price}{*Цена*}</td>
						<td class="basket_td6" style="border-top:1px solid #D7D1CC; border-bottom:1px solid #D7D1CC">{$webtext_total}{*Сума*}</td>
					</tr>
					{foreach key=id item=orderItem from=$orderItems name=orderItems}
					<tr>
						<td class="basket_td5" {if $rubbleItems} colspan="3"{/if}>
							{$orderItem.title}{if $orderItem.listId==2}<font color="#FF0000">*</font>{/if}
							<div>{if $orderItem.variation1}<span style="color:#828282;font-weight:bold;">{$orderItem.variationName1}</span>:&nbsp;{$orderItem.variationItemName1}{/if}</div>
							<div>{if $orderItem.variation2}<span style="color:#828282;font-weight:bold;">{$orderItem.variationName2}</span>:&nbsp;{$orderItem.variationItemName2}{/if}</div>
							<div>{if $orderItem.variation3}<span style="color:#828282;font-weight:bold;">{$orderItem.variationName3}</span>:&nbsp;{$orderItem.variationItemName3}{/if}</div>
						</td>
						<td class="basket_td6">
							{$orderItem.quantity}&nbsp;{$webtext_countitem}{*шт.*}
						</td>
						<td class="basket_td6">
							{if $orderItem.listId==2}{$orderItem.servicePrice}{else}{$orderItem.price}{/if}
						</td>
						<td class="basket_td6">
							{$orderItem.lineSum}
						</td>
					</tr>
					{/foreach}
					<tr class="total_payment_row">
						<td colspan="4" style="font-size:14px; border-top:1px solid #D7D1CC; border-bottom:1px solid #D7D1CC">{$webtext_total}{*Сума*}:&nbsp;&nbsp;&nbsp;{$totalPrice}</td>
					</tr>
				</table>
				<font style="font-size: 10px">
					* - {$webtext_serviceNotice}{*внимание, цены на список услуг не входят в общую стоимость*}
				</font>
			</div>
	    </div>
	</body>
</html>
