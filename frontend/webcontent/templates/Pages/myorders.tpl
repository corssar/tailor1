<div class="pageContent">
    <h1>{$title}</span></h1>
    {if isset($introHtml)}
    <div class="content_faq">
        {$introHtml}
    </div>
    {/if}
    {if isset($orders)}
        <table class="user-orders-list">
            <thead>
            <tr>
                <td style="width: 210px; text-align:left;">Order id</td>
                <td style="width: 100px;">Price</td>
                <td style="width: 150px;">Date</td>
                <td style="width: 100px;">Status</td>
            </tr>
            </thead>
            <tbody>
            {foreach item=item from=$orders}
                <tr>
                    <td>
                        {$item.orderId}
                    </td>
                    <td>
                        {price_format price = $item.totalPrice}
                    </td>
                    <td>
                        {$item.createDate}
                    </td>
                    <td>
                        {$item.orderStatus}
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    {else}
        <p>{webtext keyword="orders-list-empty" value="Your orders list is empty" remark="Orders list"}</p>
    {/if}

</div>