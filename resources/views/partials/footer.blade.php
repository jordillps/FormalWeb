@php
    $setting = \App\Models\Setting::first();
@endphp

<!-- ========== Home Footer Start============= -->
<footer class="footer1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 d-flex align-items-center wow animate fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                <div class="footer-wrrap">
                    <div class="footer-icon">
                        <img src="{{ asset('img/logoFormalWeb_8.png') }}" alt="logo Formal Web" title="logo Formal Web">
                    </div>
                    <p>{{ $setting->text }}</p>
                    <a class="footer-btn eg-btn btn--primary btn--lg mb-30" href="{{ route('contact') }}">{{ __('web.lets-chat') }}</a>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 d-flex align-items-center justify-content-center text-center order-lg-2 order-3 wow animate fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                <div class="footer-wrrap1">
                    <div class="social-icon">
                        <span>{{ __('web.follow-me') }}:</span>
                        <ul>
                            <li><a href="{{ $setting->linkedin_url }}" target="blank" aria-label="linkedin">
                                <span class="visually-hidden">Linkedin</span>
                                <i class='bx bxl-linkedin'></i></a></li>
                            <li><a href="{{ $setting->twitter_url }}" target="blank" aria-label="twitter">
                                <span class="visually-hidden">Twitter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><g fill="#ffffff"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></g></svg></a></li>
                            <li><a href="{{ $setting->facebook_url }}" target="blank" aria-label="facebook">
                                <span class="visually-hidden">Facebook</span>
                                <i alt="logo facebook" class='bx bxl-facebook' ></i></a></li>
                        </ul>
                    </div>
                    <div class="footer-menu">
                        <nav>
                            <ul>
                                <li><a href="{{ route('home') }}" accesskey="n">{{ __('web.home') }}</a></li>
                                <li><a href="{{ route('about-me') }}" accesskey="a">{{ __('web.about-me') }}</a></li>
                                <li><a href="{{ route('services') }}" accesskey="s">{{ __('web.services') }}</a></li>
                                <li><a href="{{ route('projects') }}" accesskey="p">{{ __('web.projects') }}</a></li>
                                <li><a href="{{ route('blog') }}" accesskey="b">{{ __('web.blog') }}</a></li>
                                <li><a href="{{ route('contact') }}" accesskey="c">{{ __('web.contact') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div  class="devlper-area">
                        <div>
                            <span id="copyright"></span>
                            <span>{{ __('web.all-rights-reserved') }} </span>
                        </div>
                        <span><a href="{{ route('legal-notice') }}" accesskey="l">{{ __('web.legal-notice') }}</a> | <a href={{ route('privacy-policy') }} accesskey="r">{{ __('web.privacy-policy') }}</a> | <a href={{ route('cookies-policy') }} accesskey="o">{{ __('web.cookies-policy') }}</a></span>
                        <div>
                            <span>{{__('web.developed-by') }} <a href="https://formalweb.cat">Formal Web</a></span>
                        </div>
                    </div>
                    <div class="footer-img">
                        @if(count($setting->getMedia('images'))>0)
                            @foreach ($setting->getMedia('images') as $media)
                            <img class="lazyload" data-src="{{ $media->getUrl() }}" alt="logos Unión Europea" title="logos Unión Europea">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 d-flex align-items-center order-lg-3 order-2 wow animate fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                <div class="footer-wrrap">
                    <h3>{{ __('web.contact') }}</h3>
                    <div class="number d-flex align-items-center">
                        <div class="num-icon">
                            <i class='bx bx-phone-call' role="presentation"></i>
                        </div>
                        <div class="phone">
                            <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                        </div>
                    </div>
                    <div class="office-mail d-flex align-items-center">
                        <div class="mail-icon">
                            <i class='bx bx-envelope' role="persentation"></i>
                        </div>
                        <div class="email">
                            <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                        </div>
                    </div>
                    <div class="address d-flex align-items-center">
                        <div class="address-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="location">
                            <a href="#" aria-label="{{ $setting->city }}" role="button">{{ $setting->city }}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ========== Home Footer End============= -->

@push('scripts')

@endpush

