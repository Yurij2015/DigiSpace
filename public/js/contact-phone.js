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
        // The typed value is re-formatted to the selected country's national mask while typing
        // (uses libphonenumber utils once they arrive); the submit handler still sends E.164.
        formatAsYouType: true,
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

    // Once the visitor leaves the field, reformat what they typed to a readable mask: national for
    // national input ("07123456789" → "07123 456789"), international for a "+"-prefixed one
    // ("+380671234567" → "+380 67 123 45 67" — the formatter detects the dial code itself).
    // When the number does not fit the displayed flag, the same country guess used on submit is
    // applied here too: the flag visibly switches, so what is shown is exactly what will be sent.
    input.addEventListener('blur', function () {
        var utils = window.intlTelInput && intlTelInput.utils;
        var raw = input.value.trim();
        if (!utils || !raw) {
            return;
        }
        try {
            var iso = raw.charAt(0) === '+' || isValid() ? selectedIso() : (guessCountry() || selectedIso());
            var pretty = utils.formatNumberAsYouType(raw, iso);
            if (pretty) {
                input.value = pretty;
            }
        } catch (e) {
            // keep the raw value
        }
    });

    // The field shows the national number; the server needs the international one. Re-reading it on
    // submit also means a server-side validation failure repopulates a number iti can parse back.
    if (input.form) {
        input.form.addEventListener('submit', function () {
            // getNumber() yields "" for input it cannot parse at all (e.g. "+999999999"): keep the
            // raw text then, so the server reports "valid number" instead of a misleading "required".
            input.value = bestNumber() || input.value;
        });
    }

    // The preselected flag is only a guess (en → gb), and visitors regularly type their national
    // number without touching it: "+44" + a Ukrainian mobile is then invalid for no real reason.
    var CANDIDATES = ['ua', 'pl', 'gb', 'us'];

    function selectedIso() {
        return ((iti.getSelectedCountry && iti.getSelectedCountry()) || {}).iso2;
    }

    // Point the selector at the first likely country whose strict validation accepts the number,
    // leaving it alone when none fits. Returns the matched iso2.
    function guessCountry() {
        var original = selectedIso();
        for (var i = 0; i < CANDIDATES.length; i++) {
            if (CANDIDATES[i] === original) {
                continue;
            }
            iti.setSelectedCountry(CANDIDATES[i]);
            if (isValid()) {
                return CANDIDATES[i];
            }
        }
        if (original) {
            iti.setSelectedCountry(original);
        }
        return null;
    }

    function bestNumber() {
        if (! isValid()) {
            // guessCountry() switches to the matching country and restores the original itself
            // when nothing fits, so getNumber() below always runs on the right selection.
            guessCountry();
        }
        return iti.getNumber();
    }

    function isValid() {
        try {
            // Precise validation checks real number ranges, not just the shape: the loose check
            // accepts "+44 660994550", which the server's libphonenumber then rejects anyway.
            if (typeof iti.isValidNumberPrecise === 'function') {
                return !! iti.isValidNumberPrecise();
            }
            return !! iti.isValidNumber();
        } catch (e) {
            // libphonenumber utils may not have loaded yet - only full validation is affected.
            return false;
        }
    }
})();
