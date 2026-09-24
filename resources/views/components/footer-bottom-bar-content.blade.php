@php use App\Support\Locales; @endphp
<div class="container">
    <div class="footer-default__aside-inner">
        <!-- Rights-->
        <p class="rights">
            <span>&copy;&nbsp;</span><span class="copyright-year"></span>
            <span>&nbsp;</span>
            <span>{{ $footerBottomBarContent->company_name }}</span>
            <span>.&nbsp;</span>
            <a href="{{ Locales::localizeUrl($footerBottomBarContent->privacy_policy_href) }}">
                {{ $footerBottomBarContent->privacy_policy_title }}
            </a>
        </p>
        <ul class="list-separated list-inline">
            <li>
                <a href="{{ Locales::localizeUrl($footerBottomBarContent->faq_href) }}">{{ $footerBottomBarContent->faq }}</a>
            </li>
            <li>
                <a href="{{ Locales::localizeUrl($footerBottomBarContent->support_href) }}">{{ $footerBottomBarContent->support }}</a>
            </li>
            <li>
                <button type="button" class="site-cookie-consent__open"
                        data-consent-open data-testid="cookie-settings"
                        aria-haspopup="dialog" aria-expanded="false"
                        aria-controls="site-cookie-consent">
                    {{ __('site.cookie_settings') }}
                </button>
            </li>
        </ul>
    </div>
</div>
