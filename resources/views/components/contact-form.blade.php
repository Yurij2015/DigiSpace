<h3 class="text-center">Contact Form</h3>
<!-- TODO - set up with RD Mailform -->
<form method="post" action="{{ route('contact.save') }}">
    @csrf
    <div class="row align-items-md-end row-30">
        @if(Session::has('success'))
            <div class="contact-success-sent">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="col-md-6 ">
            <div class="form-wrap contact-form-input">
                <input class="form-input {{ $errors->has('name') ? 'error' : '' }}" id="contact-name" type="text"
                       name="name">
                @if ($errors->has('name'))
                    <label class="form-label label-error" for="contact-name">{{ $errors->first('name') }}</label>
                @else
                    <label class="form-label" for="contact-name">Your Name</label>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-wrap contact-form-input">
                <input class="form-input {{ $errors->has('phone') ? 'error' : '' }}" id="contact-phone" type="text"
                       name="phone">
                @if ($errors->has('phone'))
                    <label class="form-label  label-error" for="contact-phone">{{ $errors->first('phone') }}</label>
                @else
                    <label class="form-label" for="contact-phone">Phone</label>
                @endif
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-wrap contact-form-input">
                <textarea class="form-input {{ $errors->has('message') ? 'error' : '' }}" id="contact-message"
                          name="message"></textarea>
                @if ($errors->has('message'))
                    <label class="form-label  label-error" for="contact-message">{{ $errors->first('message') }}</label>
                @else
                    <label class="form-label" for="contact-message">Your Message</label>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-wrap contact-form-input">
                <input class="form-input {{ $errors->has('email') ? 'error' : '' }}" id="contact-email" type="email"
                       name="email">
                @if ($errors->has('phone'))
                    <label class="form-label label-error" for="contact-email">{{ $errors->first('email') }}</label>
                @else
                    <label class="form-label" for="contact-email">E-mail</label>
                @endif
            </div>
        </div>
        <div class="col-md-6 send-message-button">
            <button class="button button-block button-primary button-ujarak" type="submit">Send Message</button>
        </div>
    </div>
</form>


<!-- RD Mailform -->
{{--<form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact"--}}
{{--      method="post" action="{{ route('contact.save') }}">--}}
{{--    @csrf--}}
{{--    <div class="row align-items-md-end row-30">--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="form-wrap">--}}
{{--                <input class="form-input {{ $errors->has('name') ? 'error' : '' }}" id="contact-name" type="text"--}}
{{--                       name="name">--}}
{{--                <label class="form-label" for="contact-name">Your Name</label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="form-wrap">--}}
{{--                <input class="form-input {{ $errors->has('phone') ? 'error' : '' }}" id="contact-phone" type="text"--}}
{{--                       name="phone">--}}
{{--                <label class="form-label" for="contact-phone">Phone</label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-12">--}}
{{--            <div class="form-wrap">--}}
{{--                <label class="form-label" for="contact-message">Your Message</label>--}}
{{--                <textarea class="form-input {{ $errors->has('message') ? 'error' : '' }}" id="contact-message"--}}
{{--                          name="message"></textarea>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="form-wrap">--}}
{{--                <input class="form-input {{ $errors->has('email') ? 'error' : '' }}" id="contact-email" type="email"--}}
{{--                       name="email">--}}
{{--                <label class="form-label" for="contact-email">E-mail</label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <input class="button button-block button-primary button-ujarak" type="submit" value="Send Message">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</form>--}}
