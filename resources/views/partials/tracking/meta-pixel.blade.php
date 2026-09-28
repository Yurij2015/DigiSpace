    <!-- Meta Pixel Code -->
    <script>
        (function () {
            var pixelId = @json(config('app.facebook_pixel_id'));
            // No consent manager (blocked or failed to load) means no basis for tracking, and an
            // unset FACEBOOK_PIXEL_ID has nothing to initialise — stay out of the way in both cases.
            if (!window.DigiConsent || !pixelId) {
                return;
            }
            DigiConsent.on('marketing', function () {
                if (window.fbq) {
                    // Granted again after a revoke: resume the existing pixel. Re-running the
                    // snippet would re-init it and send a second PageView for the same visit.
                    fbq('consent', 'grant');
                    return;
                }
                !function (f, b, e, v, n, t, s) {
                    if (f.fbq) return;
                    n = f.fbq = function () {
                        n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };
                    if (!f._fbq) f._fbq = n;
                    n.push = n;
                    n.loaded = !0;
                    n.version = '2.0';
                    n.queue = [];
                    t = b.createElement(e);
                    t.async = !0;
                    t.src = v;
                    s = b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s)
                }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', pixelId);
                fbq('track', 'PageView');
            }, function () {
                // fbevents.js cannot be unloaded once injected; revoking consent is what actually
                // stops it sending, so a visitor who turns Marketing off is no longer tracked.
                if (window.fbq) {
                    fbq('consent', 'revoke');
                }
            });
        })();
    </script>
    <!-- End Meta Pixel Code -->
