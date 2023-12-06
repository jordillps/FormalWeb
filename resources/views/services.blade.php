@extends('layouts.app')

@push('styles')
  
@endpush

@section('seo')
    <!-- SEO meta -->
    {!! SEOMeta::generate() !!}
    <!-- SEO Open Graph -->
    {!! OpenGraph::generate() !!}
    <!-- SEO Twitter -->
    {!! Twitter::generate() !!}
    <!-- SEO Json-Ld -->
    {!! JsonLd::generate() !!}

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <link rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ca') }}">
    <link rel="canonical" href="{{ LaravelLocalization::getLocalizedURL()}}">
@endsection

@section('content')

<!-- ========== breadcump Start============= -->
<div class="inner-page-banner">
    <div class="inner-banner-top">
        <div class="breadcrumb-area" role="navigation" aria-label="{{ __('web.services') }}">
           <div class="container">
               <div class="row">
                   <div class="col-12 d-flex justify-content-end">
                        <div class="inner-breadcrumb" role="contentinfo">
                            <h1>{{ __('web.services') }}</h1>
                            <nav>
                                <ol class="breadcrumb" role="navigation" aria-label="{{ __('web.services') }}">
                                  <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('web.home') }}</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ __('web.services') }}</li>
                                </ol>
                              </nav>
                        </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>
<!-- ========== breadcump end============= -->

<!-- ==========services Start============= -->
<div class="services-details pt-120 mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 order-lg-1 order-2 wow animate fadeInDown" data-wow-delay="400ms" data-wow-duration="1500ms">
                @foreach ($services as $service)
                    <div class="service-details-wrrap pb-60" role="contentinfo" arial-label="descipción de los servicios">
                        @if(count($service->getMedia('images'))>0)
                            <div class="service-img-1">
                                <img class="img-fluid" src="{{ $service->getMedia('images')[0]->getUrl() }}" alt="{{ $service->{'title:'. app()->getLocale()} }}" title="{{ $service->{'title:'. app()->getLocale()} }}">
                            </div>
                        @endif
                        <div class="services-top d-flex justify-content-between align-items-center">
                            <div class="icon">
                                <img src="{{ asset('img/web/icons/'. $service->icon) }}" alt="{{ $service->{'title:'. app()->getLocale()} }}" title="{{ $service->{'title:'. app()->getLocale()} }}" width="60">
                            </div>
                            <h2>{{ $service->{'title:'. app()->getLocale()} }}</h2>
                        </div>
                        <div class="service-body">
                            {!! $service->{'body:'. app()->getLocale()} !!}
                        </div>
                        @if(count($service->getMedia('images'))>0) 
                            <div class="services-technologies">
                                @foreach($service->getMedia('images') as $media)
                                    @php
                                       $technology_name=substr($media->name, strpos($media->name, "_") + 1); 
                                    @endphp
                                    @if($loop->index != 0)
                                        <img src="{{ $media->getUrl() }}" alt="Logo {{ $technology_name }}" title="Logo {{ $technology_name }}" width="70" height="70">
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
               
            </div>
            <div class="col-lg-4 order-lg-2 order-1">
                <div class="blog-sidebar">
                    <div class="blog-widget-item wow animate fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="top-blog">
                            <div class="sidebar-widget-title">
                                <h3>{{ __('web.categories') }}</h3>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="category-list">
                                    @foreach ($services as $service)
                                        <li><a href="#" role="button"><h4>{{ $service->{'title:'. app()->getLocale()} }}</h4></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow animate fadeInUp" data-wow-delay="800ms" data-wow-duration="1500ms">
                        <div class="tag-area">
                            <div class="sidebar-widget-title">
                                <h3>{{ __('web.follow-me') }}</h3>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="sidebar-social-list gap-4">
                                    <li><a href="{{ $setting->linkedin_url }}" target="blank" aria-label="linkedin">
                                        <span class="visually-hidden">Linkedin</span>
                                        <i alt="logo linkedin" class="bx bxl-linkedin"></i></a></li>
                                    <li><a href="{{ $setting->twitter_url }}" target="blank" aria-label="twitter">
                                        <span class="visually-hidden">Twitter</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><g fill="#ffffff"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></g></svg></a></li>
                                    <li><a href="{{ $setting->facebook_url }}" target="blank" aria-label="facebook">
                                        <span class="visually-hidden">Facebook</span>
                                        <i alt="logo facebook" class="bx bxl-facebook"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==========services End============= -->
     
    
@endsection

@push('scripts')
  
@endpush