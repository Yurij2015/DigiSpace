/* DigiSpace public-site behaviour on top of the theme (script.js). Loaded last. */
(function () {
    'use strict';

    // Language switcher (<details>): close on outside click / Escape; <details> itself needs no JS to work.
    document.addEventListener('click', function (event) {
        document.querySelectorAll('.site-language-control__menu[open]').forEach(function (menu) {
            if (!menu.contains(event.target)) {
                menu.removeAttribute('open');
            }
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') {
            return;
        }
        document.querySelectorAll('.site-language-control__menu[open]').forEach(function (menu) {
            menu.removeAttribute('open');
            menu.querySelector('summary').focus();
        });
    });

    // Header menu labels without a destination (e.g. "Pages"): the theme opens the megamenu on hover/touch only,
    // so give keyboard users Enter/Space to toggle it and Escape to close.
    document.querySelectorAll('.rd-navbar-nav__label').forEach(function (label) {
        var item = label.parentElement;
        var setOpen = function (open) {
            item.classList.toggle('focus', open);
            label.setAttribute('aria-expanded', open ? 'true' : 'false');
        };

        label.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                setOpen(!item.classList.contains('focus'));
            } else if (event.key === 'Escape') {
                setOpen(false);
            }
        });

        item.addEventListener('focusout', function (event) {
            if (!item.contains(event.relatedTarget)) {
                setOpen(false);
            }
        });
    });
})();
