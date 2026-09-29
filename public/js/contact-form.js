/* Contact form: invisible reCAPTCHA v3 + AJAX submit. The v3 library is loaded lazily (first
   focus or when the form scrolls into view - it costs ~300 ms and sets Google cookies), a fresh
   token is minted on every submit because v3 tokens live two minutes, and the server response is
   mirrored without a page reload: success bar, per-field floating-label errors, the captcha error
   line and the throttle notice. Without JS the form falls back to a normal POST + redirect. */
(function () {
    'use strict';

    var form = document.querySelector('[data-contact-form]');
    if (!form || !window.fetch) {
        return;
    }

    var successBox = form.querySelector('[data-contact-success]');
    var errorBox = form.querySelector('[data-contact-error]');
    var captchaError = form.querySelector('[data-captcha-error]');
    var tokenField = form.querySelector('[data-recaptcha-token]');
    var submitButton = form.querySelector('button[type="submit"]');
    var siteKey = form.dataset.recaptchaSitekey;
    var action = form.dataset.recaptchaAction;
    var submitting = false;

    var loading = null;
    function loadRecaptcha() {
        if (!siteKey) return Promise.reject(new Error('no site key'));
        if (!loading) {
            loading = new Promise(function (resolve, reject) {
                var script = document.createElement('script');
                script.src = 'https://www.google.com/recaptcha/api.js?render=' + encodeURIComponent(siteKey);
                script.async = true;
                script.onload = function () { window.grecaptcha.ready(resolve); };
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }
        return loading;
    }

    // Warm the library up before the visitor reaches the button, so submit does not wait on it.
    form.addEventListener('focusin', loadRecaptcha, { once: true });
    if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (entries, observer) {
            if (entries.some(function (entry) { return entry.isIntersecting; })) {
                observer.disconnect();
                loadRecaptcha();
            }
        }, { rootMargin: '800px 0px' }).observe(form);
    }

    function mintToken() {
        if (!siteKey || !tokenField) return Promise.resolve();
        return loadRecaptcha()
            .then(function () { return window.grecaptcha.execute(siteKey, { action: action }); })
            .then(function (token) { tokenField.value = token; })
            // Without a token the server answers with a clear validation message.
            .catch(function () { tokenField.value = ''; });
    }

    function hide(el) {
        if (el) el.hidden = true;
    }

    function show(el, text) {
        if (!el) return;
        if (text) el.textContent = text;
        el.hidden = false;
    }

    function fieldWrap(input) {
        return input && input.closest('.form-wrap');
    }

    function fieldLabel(input) {
        var wrap = fieldWrap(input);
        var label = wrap && wrap.querySelector('.form-label');
        if (!label && wrap) {
            // The phone field keeps its visible label outside the input (the country selector sits
            // inside), so an error line is created under the input like the server-side render does.
            label = document.createElement('span');
            label.className = 'form-label';
            label.dataset.created = '1';
            wrap.appendChild(label);
        }
        return label;
    }

    function clearFieldErrors() {
        form.querySelectorAll('.form-input.error').forEach(function (input) {
            input.classList.remove('error');
            input.removeAttribute('aria-invalid');
        });
        form.querySelectorAll('.form-label.label-error').forEach(function (label) {
            if (label.dataset.created === '1') {
                label.remove();
            } else if (label.dataset.origText !== undefined) {
                label.textContent = label.dataset.origText;
                label.classList.remove('label-error');
            }
        });
    }

    function showFieldError(name, message) {
        var input = form.querySelector('[name="' + name + '"]');
        if (!input) return;
        input.classList.add('error');
        input.setAttribute('aria-invalid', 'true');
        var label = fieldLabel(input);
        if (!label) return;
        if (label.dataset.origText === undefined) {
            label.dataset.origText = label.textContent;
        }
        label.textContent = message;
        label.classList.add('label-error');
    }

    function handleErrors(errors) {
        var shown = 0;
        Object.keys(errors || {}).forEach(function (name) {
            var first = errors[name] && errors[name][0];
            if (!first) return;
            if (name === 'g-recaptcha-response') {
                show(captchaError, first);
            } else if (name === 'throttle') {
                show(errorBox, first);
            } else {
                showFieldError(name, first);
            }
            shown++;
        });
        return shown;
    }

    form.addEventListener('submit', function (event) {
        if (submitting) return;
        event.preventDefault();
        submitting = true;
        if (submitButton) submitButton.disabled = true;

        hide(successBox);
        hide(errorBox);
        hide(captchaError);
        clearFieldErrors();

        mintToken()
            .then(function () {
                return fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
            })
            .then(function (response) {
                return response.json().catch(function () { return {}; })
                    .then(function (data) { return { status: response.status, data: data }; });
            })
            .then(function (result) {
                if (result.status === 200) {
                    show(successBox, result.data.message);
                    form.reset();
                    return;
                }
                if (!handleErrors(result.data.errors)) {
                    show(errorBox, result.data.message || form.dataset.errorGeneric);
                }
            })
            .catch(function () {
                show(errorBox, form.dataset.errorGeneric);
            })
            .finally(function () {
                submitting = false;
                if (submitButton) submitButton.disabled = false;
            });
    });
})();
