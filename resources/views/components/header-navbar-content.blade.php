<div class="rd-navbar-content-outer">
    <div class="rd-navbar-content__toggle rd-navbar-static--hidden"
         data-rd-navbar-toggle=".rd-navbar-content">
        <span></span>
    </div>
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
                        <a class="icon icon-gray-dark icon-style-brand fa
                        {{ $headerNavBarContent->first_soc_button_style }}"
                           href="https://{{ $headerNavBarContent->first_soc_button_href }}" target="_blank"></a>
                    </li>
                    <li>
                        <a class="icon icon-gray-dark icon-style-brand fa
                        {{ $headerNavBarContent->second_soc_button_style }}"
                           href="https://{{ $headerNavBarContent->second_soc_button_href }}" target="_blank"></a>
                    </li>
                    <li>
                        <a class="icon icon-gray-dark icon-style-brand fa
                        {{ $headerNavBarContent->third_soc_button_style }}"
                           href="https://{{ $headerNavBarContent->third_soc_button_href }}" target="_blank"></a>
                    </li>
                    <li>
                        <a class="icon icon-gray-dark icon-style-brand fa
                        {{ $headerNavBarContent->fourth_soc_button_style }}"
                           href="https://{{ $headerNavBarContent->fourth_soc_button_href }}" target="_blank"></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@if($headerNavBarContent->login_button_status)
    <x-login-button/>
@endif
