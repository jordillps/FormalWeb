<div class="col-lg-8 wow animate fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
    <div class="contact-form-area mb-120">
        <h2>{{ __('web.need-help-contact') }}</h2>
        <p>{{ __('web.need-help-contact-text') }} <span><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></span></p>
        <form method="POST" id="contact-form" action="{{ route('contacts.store') }}">
            {{ csrf_field() }}
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="form-inner">
                        <input type="text" name="name" aria-label="name" class="form-control" id="name" placeholder="{{ __('web.your-name') }}" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger"> <strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-inner">
                        <input type="email" class="form-control" name="email" aria-label="email" id="email" placeholder="{{ __('web.your-email') }}" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger"> <strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-inner">
                        <input type="text" class="form-control" name="phone" aria-label="phone" id="phone" placeholder="{{ __('web.your-phone') }}" value="{{ old('phone') }}">
                        @error('phone')
                            <small class="text-danger"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-inner">
                        <input type="text" class="form-control" name="subject" aria-label="subject" id="subject" placeholder="{{ __('web.your-subject') }}" value="{{ old('subject') }}">
                        @error('subject')
                            <small class="text-danger"> <strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-inner">
                        <textarea class="form-control" name="message" aria-label="message" rows="5"
                            placeholder="{{ __('web.your-message') }}"></textarea>
                        @error('message')
                            <small class="text-danger"> <strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" aria-label="accept privacy" name="accept-privacy" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('web.accept-privacy-policy') }}
                            <a href={{ route('privacy-policy') }} accesskey="r"><span>{{ __('web.privacy-policy') }}</span></a>
                        </label>
                        @error('accept-privacy')
                            <p><small class="text-danger"> <strong>{{ $message }}</strong></small></p>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    @error('token')
                        <p><small class="text-danger"> <strong>{{ $message }}</strong></small></p>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="form-inner">
                        <button  class="eg-btn btn--primary btn--md form--btn" type="submit">{{ __('web.send-message') }}</button>
                        {{-- <button class="eg-btn btn--primary btn--md form--btn g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onSubmit" data-action="submit" type="submit">{{ __('web.send-message') }}</button> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
