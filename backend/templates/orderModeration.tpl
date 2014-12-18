<input type="hidden" id="moderateOrder" value="" />
<div id="orderModerationBtnsContainer" style="display:none;">
    <div class="orderModerationBtnsHolder">
        <div class="orderModerationBtns">
            <a href="#" class="prevOrderBtn" onclick="window.parent.prevOrder();return false;"></a>
            <a href="#" class="nextOrderBtn" onclick="window.parent.nextOrder();return false;"></a>
            <a href="#" class="fullScreenBtn" onclick="window.parent.toggleFullScreen();return false;"></a>
            <div class="fieldsList">
                <div id="orderStatus">
                    <div class="fieldTitle">Order status:</div>
                    <div class="fieldContainer">
                        <select id="orderStatusId" onchange="window.parent.changeOrderStatus(this);" curstatus="">
                            {foreach item=status from=$statuses}
                                <option value="{$status.statusId}">{$status.title}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                {*<div id="trackingNumber">
                    <div class="fieldTitle">Shipment tracking number:</div>
                    <div class="fieldContainer">
                        <input type="text" id="shippingTrackingNumber" value="" />
                    </div>
                </div>*}
                <div id="orderStatusNotify" style="display: none;">
                    <div class="fieldTitle">Comment:</div>
                    <div class="fieldContainer">
                        <textarea id="notificationEmailText"></textarea>
                        <a href="#" class="my-account-button" onclick="window.parent.applyOrderStatusChanges();">{$webtext_applyOrderModeration}{*Apply*}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="orderViewHolder" class="searchResultTable" style="display:none;">
    <iframe id="myIframe" src="" width="941px" height="700px"></iframe>
</div>