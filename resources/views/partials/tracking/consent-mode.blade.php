    <!-- Google Consent Mode defaults: all storage denied until the visitor grants a category (see public/js/consent.js) -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('consent', 'default', {
            'analytics_storage': 'denied',
            'ad_storage': 'denied',
            'ad_user_data': 'denied',
            'ad_personalization': 'denied'
        });
    </script>
    <script src="{{ asset('js/consent.js') }}"></script>
