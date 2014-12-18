{literal}
<script type="text/javascript">
    $(document).ready(function(){
        $("#passwordRemember").validationEngine({
                inlineValidation: true,
                autoPositionUpdate:true,
                scroll:false
        });
    });
</script>
{/literal}
<div class="shell">
    <h1>{$confirmationSuccessMessage}</h1>
</div>