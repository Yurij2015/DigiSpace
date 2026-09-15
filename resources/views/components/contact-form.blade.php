<h3 class="text-center">{{ __('site.contact_form') }}</h3>
<form method="post" action="{{ route('contact.save') }}">
    @csrf
    <div class="row align-items-md-end row-30">
        @if(Session::has('success'))
            <div class="col-12">
                <output class="contact-success-sent">
                    {{ Session::get('success') }}
                </output>
            </div>
        @endif
        @php
            $contactFields = [
                ['name' => 'first_name', 'id' => 'first-name', 'label' => __('site.first_name'), 'type' => 'text', 'autocomplete' => 'given-name', 'col' => 'col-md-4'],
                ['name' => 'last_name', 'id' => 'last-name', 'label' => __('site.last_name'), 'type' => 'text', 'autocomplete' => 'family-name', 'col' => 'col-md-4'],
                ['name' => 'phone', 'id' => 'contact-phone', 'label' => __('site.phone'), 'type' => 'tel', 'autocomplete' => 'tel', 'col' => 'col-md-4'],
            ];
        @endphp
        @foreach($contactFields as $field)
            <div class="{{ $field['col'] }}">
                <div class="form-wrap contact-form-input">
                    <input class="form-input @error($field['name']) error @enderror" id="{{ $field['id'] }}"
                           type="{{ $field['type'] }}" name="{{ $field['name'] }}" value="{{ old($field['name']) }}"
                           autocomplete="{{ $field['autocomplete'] }}" required
                           @error($field['name']) aria-invalid="true" @enderror>
                    @error($field['name'])
                        <label class="form-label label-error" for="{{ $field['id'] }}">{{ $message }}</label>
                    @else
                        <label class="form-label" for="{{ $field['id'] }}">{{ $field['label'] }}</label>
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
        @error('g-recaptcha-response')
            <div class="col-12">
                <span class="m-0 recaptchaStyle" role="alert">{{ $message }}</span>
            </div>
        @enderror
        <div class="col-md-6">
            <div class="g-recaptcha"
                 data-size="normal"
                 data-sitekey="{{ config('services.recaptcha.site_key') }}"
            ></div>
        </div>
        <div class="col-md-6 send-message-button">
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
    </style>
@endpush
