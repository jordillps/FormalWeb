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
@endsection

@section('content')

<!-- ========== breadcump Start============= -->
<div class="inner-page-banner">
    <div class="inner-banner-top">
        <div class="breadcrumb-area" role="navigation" aria-label="{{ __('web.about-me') }}">
           <div class="container">
               <div class="row">
                   <div class="col-12 d-flex justify-content-end">
                        <div class="inner-breadcrumb" role="contentinfo">
                            <h1>{{ __('web.about-me') }}</h1>
                            <nav>
                                <ol class="breadcrumb" role="navigation" aria-label="{{ __('web.about-me') }}">
                                  <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('web.home') }}</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ __('web.about-me') }}</li>
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

<!-- ==========About-work Start============ -->
<div class="about-work pt-120 mb-120">
    <div class="container">
        <div class="row align-items-xl-center align-items-start">
            <div class="col-lg-5 d-flex justify-content-center wow animate fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                @if(count($about->getMedia('images'))>0)
                    <div class="about-img">
                        <img class="img-fluid" src="{{ $about->getMedia('images')[0]->getUrl() }}" alt="desarrollador web freelance"
                        title="desarrollador web freelance">
                    </div>
                @endif
            </div>
            <div class="col-lg-7">
                <div class="about-content">
                    <div class="section-title5 wow animate fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <span>{{ __('web.working-over-years') }}</span>
                        <h2>{{ $about->{'slogan:'. app()->getLocale()} }}</h2>
                        <p>{!! $about->{'about_me:'. app()->getLocale()} !!}</p>
                    </div>
                    <div class="about-tab">
                        <ul class="nav nav-pills mb-3 wow animate fadeInUp" data-wow-delay="500ms" data-wow-duration="1500ms" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('web.my-details') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('web.experience') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                                    type="button" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('web.technologies') }}</button>
                            </li>
                        </ul>
                        <div class="tab-content wow animate fadeInUp" data-wow-delay="700ms" data-wow-duration="1500ms" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                                tabindex="0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="about-details">
                                        <ul>
                                            <li>
                                                <span>{{ __('web.name') }}</span>
                                                <p class="about-data">{{ $about->name }}</p>
                                            </li>
                                            <li>
                                                <span>{{ __('web.email') }}</span>
                                                <p class="about-data">{{ $about->email }}</p>
                                            </li>
                                            <li>
                                                <span>{{ __('web.languages') }}</span>
                                                <p class="about-data">{{ $about->{'languages:'. app()->getLocale()} }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="about-details">
                                        <ul>
                                            <li>
                                                <span>{{ __('web.phone') }}</span>
                                                <p class="about-data">{{ $about->phone }}</p>
                                            </li>
                                            <li>
                                                <span>{{ __('web.city') }}</span>
                                                <p class="about-data">{{ $about->city }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="row">
                                    <div class="aboutme">
                                        <div class="card-body resume">
                                            <h3 class="resume-title">{{ __('web.education') }}</h3>
                                            <div class="resume-item pb-0">
                                                <h4>{{ __('web.degree-1') }}</h4>
                                                <p class="about-data">1987 - 1990</p>
                                                <p><em>Universitat Politècnica de Catalunya</em></p>
                                            </div>
                                            <div class="resume-item pb-0">
                                                <h4>{{ __('web.degree-2') }}</h4>
                                                <p class="about-data">2012 - 2016</p>
                                                <p><em>Universitat Oberta de Catalunya</em></p>
                                            </div>
                                            <h3 class="resume-title">{{ __('web.experience') }}</h3>
                                            <div class="resume-item">
                                                <h4>{{ $about->{'profession:'. app()->getLocale()} }}</h4>
                                                <p class="about-data">2019 - Actualitat</p>
                                                {{-- <p><em>{{ __('web.text-about') }}</em></p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="progress-area pt-20">
                                            <div class="progress-items">
                                                <h6>HTML5</h6>
                                                <div class="donate">
                                                    <div class="donate-done" style="width:{{ $about->html }}%;"></div>
                                                    <span>{{ $about->html }}%</span>
                                                </div> 
                                            </div>
                                            <div class="progress-items">
                                                <h6>CSS3</h6>
                                                <div class="donate">
                                                    <div class="donate-done" style="width:{{ $about->css }}%;"></div>
                                                    <span>{{ $about->css }}%</span>
                                                </div>
                                            </div>
                                            <div class="progress-items">
                                                <h6>BOOTSTRAP</h6>
                                                <div class="donate">
                                                    <div class="donate-done" style="width:{{ $about->bootstrap }}%;"></div>
                                                    <span>{{ $about->bootstrap }}%</span>
                                                </div>
                                            </div>
                                            <div class="progress-items">
                                                <h6>PHP</h6>
                                                <div class="donate">
                                                    <div class="donate-done" style="width:{{ $about->php }}%;"></div>
                                                    <span>{{ $about->php }}%</span>
                                                </div>
                                            </div>
                                            <div class="progress-items">
                                                <h6>LARAVEL</h6>
                                                <div class="donate">
                                                    <div class="donate-done" style="width:{{ $about->laravel }}%;"></div>
                                                    <span>{{ $about->laravel }}%</span>
                                                </div>
                                            </div>
                                            <div class="progress-items">
                                                <h6>JAVASCRIPT</h6>
                                                <div class="donate">
                                                    <div class="donate-done" style="width:{{ $about->javascript }}%;"></div>
                                                    <span>{{ $about->javascript }}%</span>
                                                </div>
                                            </div>
                                            <div class="progress-items">
                                                <h6>MYSQL</h6>
                                                <div class="donate">
                                                    <div class="donate-done" style="width:{{ $about->mysql }}%;"></div>
                                                    <span>{{ $about->mysql }}%</span>
                                                </div>
                                            </div>
                                            <div class="progress-items">
                                                <h6>GIT</h6>
                                                <div class="donate">
                                                    <div class="donate-done" style="width:{{ $about->git }}%;"></div>
                                                    <span>{{ $about->git }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==========About-work End============= -->
     
    
@endsection

@push('scripts')
  
@endpush