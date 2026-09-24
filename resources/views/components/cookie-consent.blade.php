{{-- Consent banner markup; public/js/consent.js shows it only when no digi_consent cookie exists.
     "Accept all" and "Reject all" stay visually equal per EDPB cookie-banner guidance.
     data-consent-* attributes drive consent.js; data-testid attributes are the test contract. --}}
<div class="site-cookie-consent" id="site-cookie-consent" role="dialog"
     aria-labelledby="site-cookie-consent__title"
     data-consent-saved-label="{{ __('site.cookie_consent_saved') }}"
     data-testid="consent-banner" hidden>
    <div class="site-cookie-consent__box">
        <button type="button" class="site-cookie-consent__dismiss" data-consent-dismiss
                data-testid="consent-dismiss"
                aria-label="{{ __('site.cookie_consent_dismiss') }}">&times;</button>
        <h2 class="site-cookie-consent__title" id="site-cookie-consent__title">{{ __('site.cookie_consent_title') }}</h2>
        <p class="site-cookie-consent__text">
            {{ __('site.cookie_consent_text') }}
            <a href="{{ route('privacy-policy', ['locale' => app()->getLocale()]) }}">{{ __('site.cookie_consent_policy_link') }}</a>.
        </p>
        <div class="site-cookie-consent__categories" id="site-cookie-consent__categories"
             data-consent-categories data-testid="consent-categories" hidden>
            <div class="site-cookie-consent__category">
                <label class="site-cookie-consent__label">
                    <span class="site-cookie-consent__label-text">
                        <span class="site-cookie-consent__name">{{ __('site.cookie_category_necessary') }}</span>
                        <span class="site-cookie-consent__hint">{{ __('site.cookie_category_necessary_hint') }}</span>
                    </span>
                    <input type="checkbox" class="site-cookie-consent__switch" role="switch"
                           checked disabled aria-checked="true"
                           data-testid="consent-toggle-necessary">
                </label>
            </div>
            <div class="site-cookie-consent__category">
                <label class="site-cookie-consent__label">
                    <span class="site-cookie-consent__label-text">
                        <span class="site-cookie-consent__name">{{ __('site.cookie_category_analytics') }}</span>
                        <span class="site-cookie-consent__hint">{{ __('site.cookie_category_analytics_hint') }}</span>
                    </span>
                    <input type="checkbox" class="site-cookie-consent__switch" role="switch"
                           data-consent-category="analytics" aria-checked="false"
                           data-testid="consent-toggle-analytics">
                </label>
            </div>
            <div class="site-cookie-consent__category">
                <label class="site-cookie-consent__label">
                    <span class="site-cookie-consent__label-text">
                        <span class="site-cookie-consent__name">{{ __('site.cookie_category_marketing') }}</span>
                        <span class="site-cookie-consent__hint">{{ __('site.cookie_category_marketing_hint') }}</span>
                    </span>
                    <input type="checkbox" class="site-cookie-consent__switch" role="switch"
                           data-consent-category="marketing" aria-checked="false"
                           data-testid="consent-toggle-marketing">
                </label>
            </div>
            <div class="site-cookie-consent__panel-actions">
                <button type="button" class="button button-primary"
                        data-consent-save data-testid="consent-save">{{ __('site.cookie_consent_save') }}</button>
                <button type="button" class="site-cookie-consent__link"
                        data-consent-accept data-testid="consent-panel-accept">{{ __('site.cookie_consent_accept') }}</button>
                <button type="button" class="site-cookie-consent__link"
                        data-consent-reject data-testid="consent-panel-reject">{{ __('site.cookie_consent_reject') }}</button>
            </div>
        </div>
        {{-- Accept and Reject share one style on purpose: equally easy AND equally prominent. --}}
        <div class="site-cookie-consent__actions" data-consent-actions data-testid="consent-actions">
            <button type="button" class="button btn-primary-outline"
                    data-consent-accept data-testid="consent-accept">{{ __('site.cookie_consent_accept') }}</button>
            <button type="button" class="button btn-primary-outline"
                    data-consent-reject data-testid="consent-reject">{{ __('site.cookie_consent_reject') }}</button>
            <button type="button" class="site-cookie-consent__link"
                    data-consent-customize data-testid="consent-customize" aria-expanded="false"
                    aria-controls="site-cookie-consent__categories">{{ __('site.cookie_consent_customize') }}</button>
        </div>
    </div>
</div>
{{-- The live region stays outside the banner: hiding the banner after a save would otherwise
     cut the announcement short. It is visually hidden by .site-cookie-consent__status. --}}
<p class="site-cookie-consent__status" role="status" data-consent-status></p>
