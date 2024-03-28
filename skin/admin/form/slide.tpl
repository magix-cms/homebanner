<div class="row">
    <form id="edit_slide" action="{$smarty.server.SCRIPT_NAME}?controller={$smarty.get.controller}&amp;tabs=slide&amp;action={if !$edit}add{else}edit{/if}" method="post" class="validate_form{if !$edit} add_form collapse in{else} edit_form{/if} col-ph-12 col-sm-8 col-md-6">
        <div id="drop-zone"{if !isset($slide.img.name) || empty($slide.img.name)} class="no-img"{/if}>
            <div id="drop-buttons" class="form-group">
                <label id="clickHere" class="btn btn-default">
                    ou cliquez ici.. <span class="fa fa-upload"></span>
                    <input type="hidden" name="MAX_FILE_SIZE" value="4048576" />
                    <input type="file" id="img" name="img" />
                    <input type="hidden" id="id_product" name="id" value="{$slide.id_slide}">
                </label>
            </div>
            <div class="preview-img">
                {if isset($slide.img.name) && !empty($slide.img.name)}
                    <img id="preview" src="/upload/homebanner/{$slide.id_slide}/{$slide.img.name}" alt="Slide" class="preview img-responsive" />
                {else}
                    <img id="preview" src="#" alt="Déposez votre images ici..." class="no-img img-responsive" />
                {/if}
            </div>
        </div>
        {include file="language/brick/dropdown-lang.tpl"}
        <div class="row">
            <div class="col-ph-12">
                <div class="tab-content">
                    {foreach $langs as $id => $iso}
                        <div role="tabpanel" class="tab-pane{if $iso@first} active{/if}" id="lang-{$id}">
                            <fieldset>
                                <legend>Texte</legend>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
                                        <div class="form-group">
                                            <label for="title_slide_{$id}">{#title_slide#|ucfirst} :</label>
                                            <input type="text" class="form-control" id="title_slide_{$id}" name="slide[content][{$id}][title_slide]" value="{$slide.content[{$id}].title_slide}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="desc_slide_{$id}">{#desc_slide#|ucfirst} :</label>
                                            <textarea class="form-control" id="desc_slide_{$id}" name="slide[content][{$id}][desc_slide]" cols="65" rows="3">{$slide.content[{$id}].desc_slide}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                                        <div class="form-group">
                                            <label for="published_slide_{$id}">Statut</label>
                                            <input id="published_slide_{$id}" data-toggle="toggle" type="checkbox" name="slide[content][{$id}][published_slide]" data-on="Publiée" data-off="Brouillon" data-onstyle="success" data-offstyle="danger"{if (!isset($slide) && $iso@first) || $slide.content[{$id}].published_slide} checked{/if}>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Options</legend>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="link_url_slide_{$id}">{#link_url_slide#|ucfirst} :</label>
                                            <input type="text" class="form-control" id="link_url_slide_{$id}" name="slide[content][{$id}][link_url_slide]" value="{$slide.content[{$id}].link_url_slide}" size="50" />
                                        </div>
                                        <div class="row">
                                            <div class="col-ph-12 col-xs-6">
                                                <label for="link_label_slide_{$id}">{#link_label_slide#|ucfirst} :</label>
                                                <input type="text" class="form-control" id="link_label_slide_{$id}" name="slide[content][{$id}][link_label_slide]" value="{$slide.content[{$id}].link_label_slide}" size="50" />
                                            </div>
                                            <div class="col-ph-12 col-xs-6">
                                                <label for="link_title_slide_{$id}">{#link_title_slide#|ucfirst} :</label>
                                                <input type="text" class="form-control" id="link_title_slide_{$id}" name="slide[content][{$id}][link_title_slide]" value="{$slide.content[{$id}].link_title_slide}" size="50" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="blank_slide_{$id}">{#blank_slide#|ucfirst}</label>
                                            <div class="switch">
                                                <input type="checkbox" id="blank_slide_{$id}" name="slide[content][{$id}][blank_slide]" class="switch-native-control"{if $slide.content[{$id}].blank_slide} checked{/if} />
                                                <div class="switch-bg">
                                                    <div class="switch-knob"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
        <fieldset>
            <legend>Enregistrer</legend>
            {if $edit}
                <input type="hidden" name="slide[id]" value="{$slide.id_slide}" />
            {/if}
            <button class="btn btn-main-theme" type="submit" name="action" value="edit">{#save#|ucfirst}</button>
        </fieldset>
    </form>
</div>