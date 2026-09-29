<h3 class="text-center">{{ __('site.contact_form') }}</h3>
<form method="post" action="{{ route('contact.save') }}" data-contact-form
      data-error-generic="{{ __('site.contact_error') }}"
      data-recaptcha-sitekey="{{ config('services.recaptcha_v3.site_key') }}"
      data-recaptcha-action="{{ \App\Http\Requests\ContactFormSaveRequest::RECAPTCHA_ACTION }}">
    <input type="hidden" name="g-recaptcha-response" data-recaptcha-token>
    @csrf
    <div class="row align-items-md-end row-30">
        <div class="col-12">
            {{-- Both bars are always in the DOM: JS toggles them on AJAX submit, and the
                 server-rendered content keeps the no-JS submit working. --}}
            <output class="contact-success-sent" data-contact-success
                    @if(!Session::has('success')) hidden @endif>{{ Session::get('success') }}</output>
            <p class="contact-form-throttle" data-contact-error role="alert"
               @if(!$errors->has('throttle')) hidden @endif>{{ $errors->first('throttle') }}</p>
        </div>
        @php
            $contactFields = [
                // The phone field takes the full width because the country selector claims ~90px of
                // it; at col-md-4 only ~54px were left for the digits and the number overflowed.
                ['name' => 'first_name', 'id' => 'first-name', 'label' => __('site.first_name'), 'type' => 'text', 'autocomplete' => 'given-name', 'col' => 'col-md-6'],
                ['name' => 'last_name', 'id' => 'last-name', 'label' => __('site.last_name'), 'type' => 'text', 'autocomplete' => 'family-name', 'col' => 'col-md-6'],
                ['name' => 'phone', 'id' => 'contact-phone', 'label' => __('site.phone'), 'type' => 'tel', 'autocomplete' => 'tel', 'col' => 'col-md-12', 'intl' => true],
            ];
        @endphp
        @foreach($contactFields as $field)
            <div class="{{ $field['col'] }}">
                {{-- The country selector occupies the start of the input, leaving no room for the
                     theme's in-field label, so this one field is labelled above it. Once the
                     selector is actually running, contact-phone.js hides this visually - the flag
                     and dial code say what the field is - but leaves it in the DOM as the input's
                     accessible name. If the library never loads, the label simply stays visible. --}}
                @if($field['intl'] ?? false)
                    <label class="form-label-outside" data-intl-label for="{{ $field['id'] }}">{{ $field['label'] }}</label>
                @endif
                <div class="form-wrap contact-form-input">
                    <input class="form-input @error($field['name']) error @enderror" id="{{ $field['id'] }}"
                           type="{{ $field['type'] }}" name="{{ $field['name'] }}" value="{{ old($field['name']) }}"
                           autocomplete="{{ $field['autocomplete'] }}" {{-- NOSONAR: token is data-driven, all values are valid HTML autocomplete tokens --}} required
                           @if($field['intl'] ?? false)
                               data-intl-phone
                               data-intl-country="{{ config('locales.phone_country.'.app()->getLocale(), 'gb') }}"
                               data-intl-utils="{{ asset('vendor/intl-tel-input/js/utils.js') }}"
                           @endif
                           @error($field['name']) aria-invalid="true" @if($field['intl'] ?? false) aria-describedby="{{ $field['id'] }}-error" @endif @enderror>
                    @error($field['name'])
                        {{-- A span, not a second <label>: the field above already names the input,
                             and two labels would concatenate into one confusing accessible name. --}}
                        @if($field['intl'] ?? false)
                            <span class="form-label label-error" id="{{ $field['id'] }}-error" role="alert">{{ $message }}</span>
                        @else
                            <label class="form-label label-error" for="{{ $field['id'] }}">{{ $message }}</label>
                        @endif
                    @else
                        @unless($field['intl'] ?? false)
                            <label class="form-label" for="{{ $field['id'] }}">{{ $field['label'] }}</label>
                        @endunless
                    @enderror
                </div>
            </div>
        @endforeach
        <div class="col-sm-12">
            <div class="form-wrap contact-form-input">
                <textarea class="form-input @error('message') error @enderror" id="contact-message" name="message"
                          required @error('message') aria-invalid="true" @enderror>{{ old('message') }}</textarea>
                @error('message')
                    <label class="form-label label-error" for="contact-message">{{ $message }}</label>
                @else
                    <label class="form-label" for="contact-message">{{ __('site.your_message') }}</label>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-wrap contact-form-input">
                <input class="form-input @error('email') error @enderror" id="contact-email" type="email" name="email"
                       value="{{ old('email') }}" autocomplete="email" required
                       @error('email') aria-invalid="true" @enderror>
                @error('email')
                    <label class="form-label label-error" for="contact-email">{{ $message }}</label>
                @else
                    <label class="form-label" for="contact-email">{{ __('site.email') }}</label>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <span class="m-0 recaptchaStyle" data-captcha-error role="alert"
                  @if(!$errors->has('g-recaptcha-response')) hidden @endif>{{ $errors->first('g-recaptcha-response') }}</span>
        </div>
        <div class="col-12">
            <p class="recaptcha-notice">
                This site is protected by reCAPTCHA and the Google
                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacy Policy</a> and
                <a href="https://policies.google.com/terms" target="_blank" rel="noopener">Terms of Service</a> apply.
            </p>
        </div>
        <div class="col-12 send-message-button">
            <button class="button button-block button-primary button-ujarak" type="submit">{{ __('site.send_message') }}</button>
        </div>
    </div>
</form>

@push('head')
    <style>
        .recaptchaStyle {
            color: red;
            font-size: 14px;
        }

        .recaptcha-notice {
            margin: 0;
            color: #9b9b9b;
            font-size: 12px;
            line-height: 1.5;
        }
    </style>
@endpush

@push('head')
    <link rel="stylesheet" href="{{ asset('vendor/intl-tel-input/css/intlTelInput.min.css') }}">
    <script defer src="{{ asset('vendor/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <script defer src="{{ asset('js/contact-phone.js') }}"></script>
    <script defer src="{{ asset('js/contact-form.js') }}"></script>
@endpush
