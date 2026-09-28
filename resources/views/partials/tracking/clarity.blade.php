<!-- Microsoft Clarity -->
<script type="text/javascript">
    (function () {
        // No consent manager means no record of a decision, so nothing may load.
        if (!window.DigiConsent) {
            return;
        }
        // No revoke handler: Clarity has no in-page off switch, so consent.js reloads the page
        // when Analytics is withdrawn.
        DigiConsent.on('analytics', function () {
            if (window.clarity) {
                // Already loaded this page; re-running the snippet would insert a second tag.
                return;
            }
            (function (c, l, a, r, i, t, y) {
                c[a] = c[a] || function () {
                    (c[a].q = c[a].q || []).push(arguments)
                };
                t = l.createElement(r);
                t.async = 1;
                t.src = "https://www.clarity.ms/tag/" + i;
                y = l.getElementsByTagName(r)[0];
                y.parentNode.insertBefore(t, y);
            })(window, document, "clarity", "script", "ylr95eawhl");
        });
    })();
</script>
<!-- End Microsoft Clarity -->
