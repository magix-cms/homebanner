{extends file="layout.tpl"}
{block name='head:title'}homebanner{/block}
{block name='body:id'}homebanner{/block}
{block name='article:header'}
    {if {employee_access type="append" class_name=$cClass} eq 1}
        <div class="pull-right">
            <p class="text-right">
                {#nbr_slide#|ucfirst}: {$slides|count}<a href="{$smarty.server.SCRIPT_NAME}?controller={$smarty.get.controller}&amp;tabs=slide&amp;action=add" title="{#add_slide#}" class="btn btn-link">
                    <span class="fa fa-plus"></span> {#add_slide#|ucfirst}
                </a>
            </p>
        </div>
    {/if}
    <h1 class="h2">homebanner</h1>
{/block}
{block name='article:content'}
{if {employee_access type="view" class_name=$cClass} eq 1}
    <div class="panels row">
    <section class="panel col-xs-12 col-md-12">
    {if $debug}
        {$debug}
    {/if}
    <header class="panel-header">
        <h2 class="panel-heading h5">Gestion de homebanner</h2>
    </header>
    <div class="panel-body panel-body-form">
        <div class="mc-message-container clearfix">
            <div class="mc-message"></div>
        </div>
        {include file="section/form/table-form-2.tpl" data=$slides idcolumn='id_slide' activation=false search=false sortable=true controller="homebanner"}
    </div>
    </section>
    </div>
    {include file="modal/delete.tpl" data_type='slide' title={#modal_delete_title#|ucfirst} info_text=true delete_message={#delete_homebanner_message#}}
    {include file="modal/error.tpl"}
    {else}
        {include file="section/brick/viewperms.tpl"}
    {/if}
{/block}

{block name="foot" append}
    {capture name="scriptForm"}{strip}
        /{baseadmin}/min/?f=libjs/vendor/jquery-ui-1.12.min.js,
        {baseadmin}/template/js/table-form.min.js,
        plugins/homebanner/js/admin.min.js
    {/strip}{/capture}
    {script src=$smarty.capture.scriptForm type="javascript"}

    <script type="text/javascript">
        $(function(){
            if (typeof homebanner == "undefined")
            {
                console.log("homebanner is not defined");
            }else{
                homebanner.run();
            }
        });
    </script>
{/block}
