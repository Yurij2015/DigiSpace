<div class="container">
    <div class="footer-default__aside-inner">
        <!-- Rights-->
        <p class="rights">
            <span>&copy;&nbsp;</span><span class="copyright-year"></span>
            <span>&nbsp;</span>
            <span>{{ $footerBottomBarContent->company_name }}</span>
            <span>.&nbsp;</span>
            <a href="{{ \App\Support\Locales::localizeUrl($footerBottomBarContent->privacy_policy_href) }}">
                {{ $footerBottomBarContent->privacy_policy_title }}
            </a>
        </p>
        <ul class="list-separated list-inline">
            <li>
                <a href="{{ \App\Support\Locales::localizeUrl($footerBottomBarContent->faq_href) }}">{{ $footerBottomBarContent->faq }}</a>
            </li>
            <li>
                <a href="{{ \App\Support\Locales::localizeUrl($footerBottomBarContent->support_href) }}">{{ $footerBottomBarContent->support }}</a>
            </li>
        </ul>
    </div>
</div>
