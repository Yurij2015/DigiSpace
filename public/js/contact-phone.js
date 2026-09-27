/* Contact form phone field: intl-tel-input adds the country selector, flag and dial code, and the
   value is normalised to full international format on submit because the server validates
   `phone:INTERNATIONAL`. Progressive enhancement only — without JS, or if the library fails to
   load, the field still accepts a hand-typed +380… number exactly as before. */
(function () {
    'use strict';

    var input = document.querySelector('[data-intl-phone]');
    if (!input || typeof intlTelInput !== 'function') {
        return;
    }

    var iti = intlTelInput(input, {
        // A locale is not a country: this only pre-selects the most likely dial code, and every
        // country stays selectable.
        initialCountry: input.getAttribute('data-intl-country') || 'gb',
        countryOrder: ['ua', 'pl', 'gb', 'us'],
        // The dial code sits beside the flag instead of inside the field, so the visitor types only
        // the national number and can still see which country the number will be read as.
        separateDialCode: true,
        // The in-field hint is an example number for the selected country, not the word "Phone":
        // it shows the expected format and re-generates when the country changes, which is the
        // documented pattern for phone inputs. Nothing overlaps it now that this field's visible
        // label lives outside the input. (v29 renamed this option from autoPlaceholder.)
        placeholderNumberPolicy: 'AGGRESSIVE',
        // libphonenumber is 261 KB, so it is fetched separately and only on this page. Formatting
        // and validation switch on once it arrives; the selector works without waiting for it.
        loadUtils: function () {
            return import(input.getAttribute('data-intl-utils'));
        }
    });

    // With the selector running, the flag and dial code identify the field, so its visible label
    // is redundant clutter above an otherwise label-inside form. It stays in the DOM - hiding it
    // here rather than in the template means a failed library load leaves it on screen.
    var outsideLabel = document.querySelector('[data-intl-label]');
    if (outsideLabel) {
        outsideLabel.classList.add('form-label-outside--hidden');
    }

    // The theme's floating label is positioned over the input, which now starts after the country
    // button. The class shifts the label clear of it.
    var wrap = input.closest('.form-wrap');
    if (wrap) {
        wrap.classList.add('contact-form-input--intl');
        // Read the offset iti actually applied rather than hard-coding the button width, so a
        // library update that changes the flag or arrow size cannot desynchronise the label.
        var syncLabelOffset = function () {
            wrap.style.setProperty('--contact-intl-label-offset', getComputedStyle(input).paddingLeft);
        };

        // iti builds its country button asynchronously and only then pads the input, and it pads it
        // again whenever a wider dial code is picked. Observing the input's own content box catches
        // every one of those - plus viewport changes - without guessing at frame counts. The
        // observer cannot loop: it only ever writes a property the label reads.
        if (typeof ResizeObserver === 'function') {
            new ResizeObserver(syncLabelOffset).observe(input);
        } else {
            requestAnimationFrame(syncLabelOffset);
            input.addEventListener('countrychange', syncLabelOffset);
            window.addEventListener('resize', syncLabelOffset);
        }
    }

    // The field shows the national number; the server needs the international one. Re-reading it on
    // submit also means a server-side validation failure repopulates a number iti can parse back.
    if (input.form) {
        input.form.addEventListener('submit', function () {
            var full = iti.getNumber();
            if (full) {
                input.value = full;
            }
        });
    }
})();
