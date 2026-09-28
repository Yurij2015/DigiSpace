<!-- Google tag (gtag.js): the library is injected only after Analytics consent; state flows through Consent Mode -->
<script>
    (function () {
        // Without the consent manager there is no record of a decision, so nothing may load.
        if (!window.DigiConsent) {
            return;
        }
        var libraryLoaded = false;
        DigiConsent.on('analytics', function () {
            gtag('consent', 'update', {'analytics_storage': 'granted'});
            if (libraryLoaded) {
                // Granted again after a revoke: the Consent Mode update above is the whole job.
                // Re-injecting the library would double-count every subsequent hit.
                return;
            }
            libraryLoaded = true;
            var gtagScript = document.createElement('script');
            gtagScript.async = true;
            gtagScript.src = 'https://www.googletagmanager.com/gtag/js?id=G-5SMHNENJQK';
            document.head.appendChild(gtagScript);
            gtag('js', new Date());
            gtag('config', 'G-5SMHNENJQK');
        }, function () {
            gtag('consent', 'update', {'analytics_storage': 'denied'});
        });
    })();
</script>
