/* Cookie consent manager: analytics/marketing scripts register via window.DigiConsent.on()
   and run only after the visitor grants that category. The decision lives in the
   first-party `digi_consent` cookie; "Cookie settings" (data-consent-open) reopens the banner. */
(function () {
    'use strict';

    var COOKIE_NAME = 'digi_consent';
    var COOKIE_MAX_AGE = 365 * 24 * 60 * 60; // 1 year
    var OPTIONAL_CATEGORIES = ['analytics', 'marketing'];

    var decision = readDecision();
    // One entry per DigiConsent.on() registration. `running` is tracked per listener, not per
    // category, so a listener registered after consent was already granted still starts, and a
    // listener that is already running is never started twice.
    var listeners = { analytics: [], marketing: [] };

    function readDecision() {
        var match = document.cookie.match(new RegExp('(?:^|; )' + COOKIE_NAME + '=([^;]*)'));
        if (!match) {
            return null;
        }
        try {
            var parsed = JSON.parse(decodeURIComponent(match[1]));
            return {
                analytics: parsed.analytics === true,
                marketing: parsed.marketing === true
            };
        } catch (e) {
            return null;
        }
    }

    function writeDecision(next) {
        var value = {
            necessary: true,
            analytics: next.analytics === true,
            marketing: next.marketing === true,
            ts: Math.floor(Date.now() / 1000)
        };
        var cookie = COOKIE_NAME + '=' + encodeURIComponent(JSON.stringify(value))
            + '; path=/; max-age=' + COOKIE_MAX_AGE + '; SameSite=Lax';
        if (location.protocol === 'https:') {
            cookie += '; Secure';
        }
        document.cookie = cookie;
        decision = { analytics: value.analytics, marketing: value.marketing };
    }

    function isGranted(category) {
        if (category === 'necessary') {
            return true;
        }
        return decision !== null && decision[category] === true;
    }

    // A failing tracker callback must never break the consent flow itself.
    function runCallback(callback) {
        try {
            callback();
        } catch (error) {
            if (window.console && console.error) {
                console.error('DigiConsent callback failed', error);
            }
        }
    }

    // A listener may be granted again after being revoked, so its onGranted has to be safe to
    // call more than once; the listener decides what "start again" means for its own tracker.
    function runGranted(category) {
        listeners[category].forEach(function (entry) {
            if (entry.running) {
                return;
            }
            entry.running = true;
            runCallback(entry.onGranted);
        });
    }

    // A listener that registered no onRevoked cannot be stopped in place once its tracker is
    // loaded (Plerdy and Clarity have no in-page off switch), so the only honest way to withdraw
    // consent is to reload the page without it. Listeners that can stop themselves - anything
    // driven by Consent Mode or fbq('consent', 'revoke') - never trigger a reload.
    var reloadToRevoke = false;

    function runRevoked(category) {
        listeners[category].forEach(function (entry) {
            if (!entry.running) {
                return;
            }
            entry.running = false;
            if (entry.onRevoked) {
                runCallback(entry.onRevoked);
            } else {
                reloadToRevoke = true;
            }
        });
    }

    function updateSettingsControls() {
        var state;
        if (decision === null) {
            state = '';
        } else if (decision.analytics && decision.marketing) {
            state = 'granted';
        } else if (decision.analytics || decision.marketing) {
            state = 'partial';
        } else {
            state = 'denied';
        }
        document.querySelectorAll('[data-consent-open]').forEach(function (control) {
            control.classList.remove('site-cookie-consent__open--granted', 'site-cookie-consent__open--partial', 'site-cookie-consent__open--denied');
            if (state !== '') {
                control.classList.add('site-cookie-consent__open--' + state);
            }
        });
    }

    function applyDecision(next) {
        writeDecision(next);
        reloadToRevoke = false;
        OPTIONAL_CATEGORIES.forEach(function (category) {
            if (next[category]) {
                runGranted(category);
            } else {
                runRevoked(category);
            }
        });
        updateSettingsControls();
        announceSaved();
        hideBanner();
        if (reloadToRevoke) {
            // The choice is already in the cookie, so the reloaded page starts without the
            // withdrawn trackers. Wait for the banner to finish hiding first.
            setTimeout(function () {
                location.reload();
            }, 600);
        }
    }

    var announceTimer = null;

    // Screen readers get no signal when the dialog just disappears, so the result is announced
    // through a polite live region that sits outside the banner (hiding the banner would cut the
    // announcement short). Clearing and repopulating in a later task is what makes the region fire
    // again when the same label is saved twice; both writes in one task look like no change at all.
    function announceSaved() {
        var status = document.querySelector('[data-consent-status]');
        var element = banner();
        if (!status || !element) {
            return;
        }
        var label = element.getAttribute('data-consent-saved-label') || '';
        clearTimeout(announceTimer);
        status.textContent = '';
        announceTimer = setTimeout(function () {
            status.textContent = label;
        }, 50);
    }

    function banner() {
        return document.getElementById('site-cookie-consent');
    }

    function categoriesPanel() {
        return document.querySelector('[data-consent-categories]');
    }

    function categoryInput(category) {
        return document.querySelector('[data-consent-category="' + category + '"]');
    }

    function setSwitch(input, value) {
        input.checked = value;
        input.setAttribute('aria-checked', value ? 'true' : 'false');
    }

    function setExpanded(selector, expanded) {
        document.querySelectorAll(selector).forEach(function (control) {
            control.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        });
    }

    var hideTimer = null;
    var pendingChoice = false;
    var lastFocused = null;

    function showBanner(withCategories) {
        var element = banner();
        if (!element) {
            return;
        }
        clearTimeout(hideTimer);
        if (element.hidden) {
            lastFocused = document.activeElement;
        }
        element.classList.remove('is-hiding');
        element.hidden = false;
        var panel = categoriesPanel();
        if (panel) {
            panel.hidden = withCategories !== true;
        }
        var actions = element.querySelector('[data-consent-actions]');
        if (actions) {
            actions.hidden = withCategories === true;
        }
        setExpanded('[data-consent-open]', true);
        setExpanded('[data-consent-customize]', withCategories === true);
        if (withCategories === true) {
            OPTIONAL_CATEGORIES.forEach(function (category) {
                var input = categoryInput(category);
                if (input) {
                    setSwitch(input, isGranted(category));
                }
            });
        }
        var focusTarget = element.querySelector(withCategories === true ? '[data-consent-save]' : '[data-consent-accept]');
        if (focusTarget) {
            focusTarget.focus();
        }
    }

    function hideBanner() {
        var element = banner();
        if (!element || element.hidden) {
            return;
        }
        element.classList.add('is-hiding');
        hideTimer = setTimeout(function () {
            element.hidden = true;
            element.classList.remove('is-hiding');
            setExpanded('[data-consent-open]', false);
            setExpanded('[data-consent-customize]', false);
            if (lastFocused && document.contains(lastFocused)) {
                lastFocused.focus();
            }
            lastFocused = null;
        }, 220);
    }

    // With the category panel already open, Accept/Reject flip the switches first so the visitor
    // sees what their click did, and the banner closes a moment later. From the opening screen
    // there are no switches on show, so flashing the panel would only delay a decision that has
    // already been made - there the choice applies straight away.
    function chooseWithFeedback(next) {
        if (pendingChoice) {
            return;
        }
        var panel = categoriesPanel();
        if (panel === null || panel.hidden) {
            applyDecision(next);
            return;
        }
        pendingChoice = true;
        OPTIONAL_CATEGORIES.forEach(function (category) {
            var input = categoryInput(category);
            if (input) {
                setSwitch(input, next[category] === true);
            }
        });
        setTimeout(function () {
            pendingChoice = false;
            applyDecision(next);
        }, 400);
    }

    function saveCustomSelection() {
        var next = { analytics: false, marketing: false };
        OPTIONAL_CATEGORIES.forEach(function (category) {
            var input = categoryInput(category);
            next[category] = input !== null && input.checked;
        });
        applyDecision(next);
    }

    function bindBanner() {
        var element = banner();
        if (!element) {
            return;
        }
        element.addEventListener('click', function (event) {
            var control = event.target.closest('[data-consent-accept],[data-consent-reject],[data-consent-customize],[data-consent-save],[data-consent-dismiss]');
            if (!control) {
                return;
            }
            if (control.hasAttribute('data-consent-accept')) {
                chooseWithFeedback({ analytics: true, marketing: true });
            } else if (control.hasAttribute('data-consent-reject')) {
                chooseWithFeedback({ analytics: false, marketing: false });
            } else if (control.hasAttribute('data-consent-customize')) {
                showBanner(true);
            } else if (control.hasAttribute('data-consent-save')) {
                saveCustomSelection();
            } else if (control.hasAttribute('data-consent-dismiss')) {
                // Closing without a choice keeps every optional category denied (no consent on record).
                hideBanner();
            }
        });
        OPTIONAL_CATEGORIES.forEach(function (category) {
            var input = categoryInput(category);
            if (input) {
                input.addEventListener('change', function () {
                    input.setAttribute('aria-checked', input.checked ? 'true' : 'false');
                });
            }
        });
        document.querySelectorAll('[data-consent-open]').forEach(function (control) {
            control.addEventListener('click', function () {
                showBanner(true);
            });
        });
        // Escape behaves like the dismiss control: close without recording a choice.
        document.addEventListener('keydown', function (event) {
            if ((event.key === 'Escape' || event.key === 'Esc') && !pendingChoice) {
                var element = banner();
                if (element && !element.hidden) {
                    hideBanner();
                }
            }
        });
        updateSettingsControls();
        if (decision === null) {
            showBanner(false);
        }
    }

    window.DigiConsent = {
        on: function (category, onGranted, onRevoked) {
            if (OPTIONAL_CATEGORIES.indexOf(category) === -1 || typeof onGranted !== 'function') {
                return;
            }
            var entry = {
                onGranted: onGranted,
                onRevoked: typeof onRevoked === 'function' ? onRevoked : null,
                running: false
            };
            listeners[category].push(entry);
            if (isGranted(category)) {
                entry.running = true;
                runCallback(entry.onGranted);
            }
        },
        isGranted: isGranted,
        grant: function (categories) {
            var next = { analytics: decision !== null && decision.analytics, marketing: decision !== null && decision.marketing };
            categories.forEach(function (category) {
                if (OPTIONAL_CATEGORIES.indexOf(category) !== -1) {
                    next[category] = true;
                }
            });
            applyDecision(next);
        },
        deny: function (categories) {
            var next = { analytics: decision !== null && decision.analytics, marketing: decision !== null && decision.marketing };
            categories.forEach(function (category) {
                if (OPTIONAL_CATEGORIES.indexOf(category) !== -1) {
                    next[category] = false;
                }
            });
            applyDecision(next);
        },
        open: function () {
            showBanner(true);
        },
        decided: function () {
            return decision !== null;
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindBanner);
    } else {
        bindBanner();
    }
})();
