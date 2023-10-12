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

    <link rel="alternate" hreflang="ca" href="{{ LaravelLocalization::getLocalizedURL('ca') }}">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        @if($localeCode != 'ca')
            <link rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
        @endif
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ca') }}">
    <link rel="canonical" href="{{ LaravelLocalization::getLocalizedURL()}}">
@endsection

@section('content')

<!-- ========== breadcump Start============= -->
<div class="inner-page-banner">
    <div class="inner-banner-top">
        <div class="breadcrumb-area" role="navigation" aria-label="{{ __('web.legal-notice') }}">
           <div class="container">
               <div class="row">
                   <div class="col-12 d-flex justify-content-end">
                        <div class="inner-breadcrumb" role="contentinfo">
                            <h1>{{ __('web.legal-notice') }}</h1>
                            <nav>
                                <ol class="breadcrumb" role="navigation" aria-label="{{ __('web.legal-notice') }}">
                                  <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('web.home') }}</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ __('web.legal-notice') }}</li>
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

<!-- ==========Cookies Policy Start============= -->
<div class="services-details pt-120 mb-120">
    <div class="container">
        <div class="row">
            <div class="col-12 wow animate fadeInDown" data-wow-delay="400ms" data-wow-duration="1500ms">
                {!! $legalNotice->{'body:'. app()->getLocale()} !!}
            </div>
        </div>
    </div>
</div>        
<!-- ==========Cookies Policy Start============= -->
     
    
@endsection

@push('scripts')
  
@endpush