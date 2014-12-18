<div style="width: 100%;">
    {if $ResultData.success == true}
        <span>{$webtext_users_export_excel_success}{*Process was successfully completed*}</span>
    {else}
        <span>{$webtext_users_export_excel_error}{*Process exited with an error*}</span>
    {/if}
</div>

