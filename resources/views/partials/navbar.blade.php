@php
    $phone = \App\Models\Setting::pluck('phone');
    const DIMENSIONS = [480, 1080, 50];

@endphp
<!-- ========== header============= -->

<header tabindex="0" class="header-area style-1">
  <div class="header-logo">
      <a href="{{ route('home') }}" accesskey="h" aria-label="Página inicio Formal Web"><img alt="Página inicio Formal Web" src="{{ asset('img/logoFormalWeb_8.png') }}" srcset="{{ asset('img/logoFormalWebMobile.png') }} 480w, {{ asset('img/logoFormalWeb_8.png') }} 1080w" sizes="50vw" title="Página inicio Formal Web"></a>
  </div>
  <div class="main-menu">
      <div class="mobile-logo-area d-lg-none d-flex justify-content-between align-items-center">
          <div class="mobile-logo-wrap ">
              <a href="{{ route('home') }}" accesskey="m" aria-label="Página inicio Formal Web para móvil"><img alt="Página inicio Formal Web para móvil" src="{{ asset('img/logoFormalWebMobile.png') }}" title="Página inicio Formal Web para móvil"></a>

          </div>
          <div class="menu-close-btn">
              <i class="bi bi-x-lg"></i>
          </div>
      </div>
      <nav>
        <ul class="menu-list">
            <li>
                <a href="{{ route('about-me') }}" accesskey="a" aria-label="{{ __('web.about-me') }}">{{ __('web.about-me') }}</a>
            </li>
            <li>
                <a href="{{ route('services') }}" accesskey="s" aria-label="{{ __('web.services') }}">{{ __('web.services') }}</a>
            </li>
            <li>
                <a href="{{ route('projects') }}" accesskey="p" aria-label="{{ __('web.projects') }}">{{ __('web.projects') }}</a>
            </li>
            <li>
                <a href="{{ route('blog') }}" accesskey="b" aria-label="{{ __('web.blog') }}">{{ __('web.blog') }}</a>
            </li>
            <li><a href="{{ route('contact') }}" accesskey="c" aria-label="{{ __('web.contact') }}">{{ __('web.contact') }}</a></li>
            @include('partials.language_switcher')
        </ul>
      </nav>
      <!-- mobile-search-area -->
      <div class="d-lg-none d-block">
          <form class="mobile-menu-form">
              <div class="hotline">
                  <div class="hotline-icon">
                      <img alt="phone image" src="{{ asset('img/web/icons/header-phone.svg') }}" >
                  </div>
                  <div class="hotline-info">
                      <h6><a href="tel:{{ $phone[0] }}" aria-label="phone mobile">{{ $phone[0] }}</a></h6>
                  </div>
              </div>
          </form>

      </div>
  </div>
  <div class="nav-right d-flex align-items-center">
      <div class="hotline d-xl-flex d-none">
          <div class="hotline-icon">
              <img alt="phone image" src="{{ asset('img/web/icons/header-phone.svg') }}" >
          </div>
          <div class="hotline-info">
              <h5><a href="tel:{{ $phone[0] }}" aria-label="phone">{{ $phone[0] }}</a></h5>
          </div>
      </div>
      <div class="mobile-menu-btn d-lg-none d-block">
          <i class='bx bx-menu'></i>
      </div>
  </div>
</header>

<!-- ========== header end============= -->