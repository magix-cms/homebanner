{homebanner_data}
{$banner = array_shift($homebanner)}
{if !empty($banner)}
    <div id="homebanner">
        <div class="figure">
            {strip}<picture>
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source type="image/webp" sizes="{$banner.img['large']['w']}px" media="(min-width: {$banner.img['medium']['w']}px)" srcset="{$banner.img['large']['src_webp']} {$banner.img['large']['w']}w">
                <source type="image/webp" sizes="{$banner.img['medium']['w']}px" media="(min-width: {$banner.img['small']['w']}px)" srcset="{$banner.img['medium']['src_webp']} {$banner.img['medium']['w']}w">
                <source type="image/webp" sizes="{$banner.img['small']['w']}px" srcset="{$banner.img['small']['src_webp']} {$banner.img['small']['w']}w">
                <source type="image/png" sizes="{$banner.img['large']['w']}px" media="(min-width: {$banner.img['medium']['w']}px)" srcset="{$banner.img['large']['src']} {$banner.img['large']['w']}w">
                <source type="image/png" sizes="{$banner.img['medium']['w']}px" media="(min-width: {$banner.img['small']['w']}px)" srcset="{$banner.img['medium']['src']} {$banner.img['medium']['w']}w">
                <source type="image/png" sizes="{$banner.img['small']['w']}px" srcset="{$banner.img['small']['src']} {$banner.img['small']['w']}w">
                <!--[if IE 9]></video><![endif]-->
                <img src="{$banner.img['small']['src']}" sizes="(min-width: {$banner.img['large']['w']}px) {$banner.img['large']['w']}px, (min-width: {$banner.img['medium']['w']}px) {$banner.img['medium']['w']}px, {$banner.img['small']['w']}px" srcset="{$banner.img['large']['src']} {$banner.img['large']['w']}w,
                                {$banner.img['medium']['src']} {$banner.img['medium']['w']}w,
                                {$banner.img['small']['src']} {$banner.img['small']['w']}w" alt="{$banner.title_slide}" title="{$banner.title_slide}" class="img-responsive lazyload" loading="lazy"/>
                </picture>{/strip}
            <div class="carousel-caption">
                <div class="container">
                    <div class="row">
                        <div class="col-12 content">
                            <div class="text-caption">
                                <p class="d6">{$banner.title_slide}</p>
                                {if $viewport != 'mobile'}
                                    <p class="content-text">{if !empty($banner.desc_slide)}{$banner.desc_slide}{/if}</p>
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
                {if isset($banner.url_slide) && !empty($banner.url_slide)}
                    <a href="{$banner.url_slide}" title="{$key.title_slide}" class="all-hover{if $banner.blank_slide} targetblank{/if}">{$banner.title_slide}</a>
                {/if}
            </div>
        </div>
    </div>
{/if}