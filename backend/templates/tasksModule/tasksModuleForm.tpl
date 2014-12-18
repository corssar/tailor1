<div class="searchFormContainer">
    <div class="searchViewTitle">{$title}</div>
    <div class="clear">&nbsp;</div>
    <div class="searchFormBlock">
        <ul class="taskTable">
            <li>
                <div class="name">{$webtext_task_title}{*Title*}</div>
                <!--<div class="progress">{$webtext_task_status}{*Прогрес*}</div>-->
                <div class="startDate">{$webtext_task_start}{*Start process*}</div>
                <div class="endDate">{$webtext_task_end}{*End of process*}</div>
                <div class="taskButton"></div>
            </li>

            {foreach key=key item=task from=$tasks}
                <li>
                    <div class="name">{$task.name}</div>
                    <!--<div class="progress">{$task.status}</div>-->
                    <div class="startDate">{$task.startDate}</div>
                    <div class="endDate">{$task.finishDate}</div>
                    <div class="loadingHolder">
                        <div id="loading" class="{$task.id}_loading"></div>
                    </div>
                    <div class="taskButton"><input type="button" onclick="runTask('{$task.id}', this)" value="{$webtext_task_start_button}{*Begin*}" class="button"></div>
                    {if $task.startParams neq null}
                        <input type="button" onclick="openParams(this);" value="{$webtext_task_params}{*Parameters*}" class="button openParams">
                    {/if}
                </li>
                {if $task.startParams neq null}
                    <li style="border-style: none; border: 1px solid #EBEBEB;" class="paramsArea">
                        <div class="params">
                            <ul>
                                {foreach key=pKey item=param from=$task.startParams}
                                    {if $param.type eq 'input'}
                                        <li param="{$param.type}">
                                            <label>{$param.text}</label>
                                            <input type='text' name='{$pKey}' id='{$task.id}_input' />
                                            <input type="hidden" id='{$task.id}_input_name' value="{$param.input}" />
                                        </li>
                                    {/if}
                                    {*<li>
                                        {if $param.type eq 'file'}
                                            <label>{$param.text}</label>
                                            <input type='file' name='{$pKey}' id='{$task.id}_file' />
                                            <input type="hidden" id='{$task.id}_file_name' value="{$param.fileName}" />
                                            <!--<input type="button" onclick="uploadPoiFile('{$task.id}', '{$param.fileName}')" value="{$webtext_task_params_file_upload}*}{*Завантажити*}{*" class="button xmlFileUpload">-->
                                            {else}
                                            {/if}
                                     </li>*}
                                    {if $param.type eq 'export_fields'}
                                        <li style="height: auto; overflow-y: auto;" param="{$param.type}">
                                            <label style="background-color: #BABABA;padding-top: 2px;width: 98%;height:22px;">{$param.text}</label>
                                            <div class="exportFormatFile">
                                                <label>{$param.export_format}</label>
                                                <div><input type="radio" name="export_format" value="{$webtext_task_param_export_format_xls}{*Excel5*}" checked >{$webtext_task_name_xls}{*XLS*}</div>
                                                <div><input type="radio" name="export_format" value="{$webtext_task_param_export_format_csv}{*CSV*}">{$webtext_task_name_csv}{*CSV*}</div>
                                            </div>
                                            <div class="exportTypeUsers">
                                            <label>{$param.export_type_users}</label>
                                                <div><input type="radio" name="export_type" value="{$webtext_task_param_export_type_register}{*active*}" checked >{$webtext_task_name_register}{*isRegister*}</div>
                                                <div><input type="radio" name="export_type" value="{$webtext_task_param_export_type_subscriber}{*isSubscriber*}">{$webtext_task_name_subscriber}{*isSubscriber*}</div>
                                            </div>
                                            <div class="siteContainer" style="display:block;height: auto;">
                                                {foreach key=sKey item=checkbox from=$param.export_fields}
                                                    <div><input type="checkbox" checked setExportFieldsId="{$checkbox.name}"/><label>{$checkbox.name}</label></div>
                                                {/foreach}
                                            </div>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </li>
                {/if}
            {/foreach}
        </ul>
    </div>
</div>
<div class='searchResultTable' id='ResultForm'>
</div>