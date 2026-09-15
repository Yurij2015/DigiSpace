<div class="rd-navbar-content-outer">
    <button type="button" class="rd-navbar-content__toggle rd-navbar-static--hidden"
         data-rd-navbar-toggle=".rd-navbar-content" aria-label="{{ __('site.toggle_contacts') }}">
        <span></span>
    </button>
    <div class="rd-navbar-content">
        <ul class="list-bordered list-inline">
            <li>
                <dl class="list-terms-inline">
                    <dt>{{ $headerNavBarContent->first_col_name }}</dt>
                    <dd>
                        <a href="{{ route($headerNavBarContent->first_col_href) }}">
                            {{ $headerNavBarContent->first_col_href_content }}
                        </a>
                    </dd>
                </dl>
            </li>
            <li>
                <dl class="list-terms-inline">
                    <dt>{{ $headerNavBarContent->second_col_name }}</dt>
                    <dd>
                        <a href="{{ $headerNavBarContent->second_col_href }}">
                            {{ $headerNavBarContent->second_col_href_content }}
                        </a>
                    </dd>
                </dl>
            </li>
            <li>
                <ul class="list-inline list-inline-xs">
                    <li>
                        <x-social-link :href="'https://'.$headerNavBarContent->first_soc_button_href"
                                       :icon="$headerNavBarContent->first_soc_button_style"/>
                    </li>
                    <li>
                        <x-social-link :href="'https://'.$headerNavBarContent->second_soc_button_href"
                                       :icon="$headerNavBarContent->second_soc_button_style"/>
                    </li>
                    <li>
                        <x-social-link :href="'https://'.$headerNavBarContent->third_soc_button_href"
                                       :icon="$headerNavBarContent->third_soc_button_style"/>
                    </li>
                    <li>
                        <x-social-link :href="'https://'.$headerNavBarContent->fourth_soc_button_href"
                                       :icon="$headerNavBarContent->fourth_soc_button_style"/>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="site-header-actions">
    @if($headerNavBarContent->login_button_status)
        <x-login-button/>
    @endif
</div>
