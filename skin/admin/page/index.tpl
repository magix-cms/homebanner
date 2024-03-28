{extends file="pages/edit.tpl"}
{block name='plugin:content'}
    test
    {*{include file="section/form/table-form-2.tpl" data=$slides idcolumn='id_slide' activation=false search=false sortable=true controller="slideshow"}
    {include file="modal/delete.tpl" data_type='slide' title={#modal_delete_title#|ucfirst} info_text=true delete_message={#delete_slideshow_message#}}
    {include file="modal/error.tpl"}*}
{/block}

{*{block name="foot" append}
    {capture name="scriptForm"}{strip}
        /{baseadmin}/min/?f=libjs/vendor/jquery-ui-1.12.min.js,
        {baseadmin}/template/js/table-form.min.js,
        plugins/slideshow/js/admin.min.js
    {/strip}{/capture}
    {script src=$smarty.capture.scriptForm type="javascript"}

    <script type="text/javascript">
        $(function(){
            if (typeof slideshow == "undefined")
            {
                console.log("slideshow is not defined");
            }else{
                slideshow.run();
            }
        });
    </script>
{/block}*}
