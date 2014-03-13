@style('system', 'system/css/system.css')
@script('updates', 'system/js/settings/updates.js', 'marketplace')
@script('marketplace', 'system/js/settings/marketplace.js', 'requirejs')

<div id="js-themes" class="uk-grid" data-api="@api" data-key="@key" data-url="@url('@system/package/install')" data-installed="@packagesJson|e" data-uk-grid-margin data-uk-grid-match>

    <div class="pk-sidebar uk-width-medium-1-4">

        <ul class="uk-nav uk-nav-side" data-uk-switcher="{connect:'#tab-content', toggle:' > *:not(.uk-nav-header)'}">
            <li class="uk-active"><a href="#">@trans('Installed')</a></li>
            <li><a href="#">@trans('Updates') <i class="uk-icon-spinner uk-icon-spin js-updates"></i></a></li>
            <li><a href="#">@trans('Install')</a></li>
            <li class="uk-nav-header">@trans('Marketplace')</li>
            <li><a href="#">@trans('All')</a></li>
        </ul>

    </div>
    <div class="pk-content uk-width-medium-3-4">

        <ul id="tab-content" class="uk-switcher uk-margin">
            <li>

                <div class="uk-grid uk-grid-width-large-1-2" data-uk-grid-margin data-uk-grid-match="{target:'.uk-panel'}">
                    @foreach (packages as name => package)
                    <div>
                        <div class="uk-panel uk-panel-box">
                            <div class="uk-panel-teaser">
                                <img src="@(package.extra.image ? url(package.repository.path ~ '/' ~ package.name ~ '/' ~ package.extra.image) : url('asset://system/images/placeholder-800x600.svg'))" width="800" height="600" alt="@package.title">
                            </div>
                            <div class="pk-themes-position">
                                <h2 class="uk-panel-title uk-margin-remove">
                                    @package.title
                                    @if (current == package)
                                    <span class="uk-badge">@trans('Active')</span>
                                    @endif
                                </h2>
                                <ul class="uk-subnav uk-subnav-line uk-margin-remove uk-text-nowrap">
                                    <li><span>@package.version</span></li>
                                    <li><a href="">@trans('Details')</a></li>
                                </ul>
                                @if (current == package)
                                <div class="pk-themes-action">
                                    <a class="uk-button" href="@url('@system/themes/settings', ['name' => name])">@trans('Settings')</a>
                                </div>
                                @else
                                <div class="pk-themes-action">
                                    <a class="uk-button uk-button-primary" href="@url('@system/themes/enable', ['name' => name, '_csrf' => app.csrf.generate])">@trans('Enable')</a>
                                    <a class="uk-button uk-button-danger " href="@url('@system/themes/uninstall', ['name' => name, '_csrf' => app.csrf.generate])">@trans('Delete')</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </li>
            <li class="js-update">

                <div class="uk-alert uk-alert-warning uk-margin-remove uk-hidden" data-msg="no-connection">
                    @trans('An error occurred in retrieving update information. Please try again later.')
                </div>

                <div class="uk-alert uk-alert-info uk-margin-remove uk-hidden" data-msg="no-updates">
                    @trans('No theme updates found.')
                </div>

            </li>
            <li class="js-upload">

                <h2 class="pk-form-heading">@trans('Install a theme')</h2>

                <form class="uk-form" action="@url('@system/package/upload', ['type' => 'theme'])" data-uk-form-file>
                    <input type="text" disabled>
                    <div class="uk-form-file">
                        <button class="uk-button">@trans('Select')</button>
                        <input type="file" name="file">
                    </div>
                    <button class="js-upload-button uk-button uk-button-primary">@trans('Upload')</button>
                </form>

                <div class="js-upload-modal uk-modal"></div>

            </li>
            <li class="js-marketplace">

                <form class="uk-form pk-options uk-clearfix">
                    <div class="uk-float-left">
                        <input type="text" name="q" placeholder="@trans('Search')">
                        <input type="hidden" name="type" value="theme">
                    </div>
                </form>

                <p class="uk-alert uk-alert-info uk-hidden" data-msg="no-packages">@trans('No themes found.')</p>
                <p class="uk-alert uk-alert-warning uk-hidden" data-msg="no-connection">@trans('Cannot connect to the marketplace. Please try again later.')</p>

                <div class="js-marketplace-content"></div>
                <div class="js-marketplace-details uk-modal"></div>

            </li>
        </ul>

    </div>

</div>
