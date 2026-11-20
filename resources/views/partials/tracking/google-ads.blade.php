@php
    $googleAdsId = config('services.google_ads.conversion_id');
@endphp
@if($googleAdsId)
    <!-- Google Ads tag (gtag.js): loads only after Marketing consent; Consent Mode v2 state updates in lockstep -->
    <script>
        (function () {
            if (!window.DigiConsent) {
                return;
            }
            var adsId = @json($googleAdsId);
            var adsLoaded = false;
            DigiConsent.on('marketing', function () {
                gtag('consent', 'update', {
                    'ad_storage': 'granted',
                    'ad_user_data': 'granted',
                    'ad_personalization': 'granted'
                });
                if (adsLoaded) {
                    return;
                }
                adsLoaded = true;
                var script = document.createElement('script');
                script.async = true;
                script.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(adsId);
                document.head.appendChild(script);
                gtag('js', new Date());
                gtag('config', adsId);
            }, function () {
                gtag('consent', 'update', {
                    'ad_storage': 'denied',
                    'ad_user_data': 'denied',
                    'ad_personalization': 'denied'
                });
            });
        })();
    </script>
@endif
