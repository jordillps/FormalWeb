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
        <div class="breadcrumb-area" role="navigation" aria-label="{{ __('web.projects') }}">
           <div class="container">
               <div class="row">
                   <div class="col-12 d-flex justify-content-end">
                        <div class="inner-breadcrumb" role="contentinfo">
                            <h1>{{ __('web.projects') }}</h1>
                            <nav>
                                <ol class="breadcrumb" role="navigation" aria-label="{{ __('web.projects') }}">
                                  <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('web.home') }}</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ __('web.projects') }}</li>
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

<!-- ==========project Start============= -->
@foreach ($projects as $project)
    <div class="project-details pt-80">
        <div class="container">
            <div class="row g-4 {{ ($loop->last) ? 'mb-120' : 'mb-20' }}">
                <div class="col-lg-8 wow animate fadeInDown" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <div class="row">
                        <div class="swiper Project1">
                            <div class="swiper-wrapper">
                                @if(count($project->getMedia('images'))>1)
                                    @foreach($project->getMedia('images') as $media)
                                        @if($loop->index != 0)
                                            <div class="swiper-slide">
                                                <div class="project1-slider-wrrap">
                                                    <div class="project-img">
                                                        <img class="img-fluid" src="{{ $media->getUrl() }}" alt="{{ $project->category->{'name:'. app()->getLocale()} }}" title="{{ $project->category->{'name:'. app()->getLocale()} }}">
                                                        <div class="batch">
                                                            <span>{{ $project->category->{'name:'. app()->getLocale()} }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="swiper-button-next-h"><i class="bi bi-arrow-right-short"></i></div>
                            <div class="swiper-button-prev-h"><i class="bi bi-arrow-left-short"></i></div>
                        </div>
                    </div>
                    <h2 class="main-title">{{ $project->{'title:'. app()->getLocale()} }}</h2>
                    <p>{!! $project->{'text:'. app()->getLocale()} !!}</p>
                </div>   
                <div class="col-lg-4">
                    <div class="project-sidebar">
                        <div class="client-deatils">
                            <ul>
                                <li class=" wow animate fadeInUp" data-wow-delay="500ms" data-wow-duration="1500ms">
                                    <p><img src="{{ asset('img/web/icons/project-sidebar-arrrow.svg') }}" alt="{{ $project->company }}" title="{{ $project->company }}">{{ __('web.company') }}:</p>
                                    <p class="projects-data">{{ $project->company }}</p>
                                </li>
                                <li class=" wow animate fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                    <p><img src="{{ asset('img/web/icons/project-sidebar-arrrow.svg') }}" alt="{{ $project->location }}" title="{{ $project->location }}">{{ __('web.location') }}:</p>
                                    <p class="projects-data">{{ $project->location }}</p>
                                </li>
                                <li class=" wow animate fadeInUp" data-wow-delay="700ms" data-wow-duration="1500ms">
                                    <p><img src="{{ asset('img/web/icons/project-sidebar-arrrow.svg') }}" alt="{{ $project->category->{'name:'. app()->getLocale()} }}" title="{{ $project->category->{'name:'. app()->getLocale()} }}">{{ __('web.category') }}:</p>
                                    <p class="projects-data">{{ $project->category->{'name:'. app()->getLocale()} }}</p>
                                </li>
                                <li class=" wow animate fadeInUp" data-wow-delay="800ms" data-wow-duration="1500ms">
                                    <p><img src="{{ asset('img/web/icons/project-sidebar-arrrow.svg') }}" alt="{{ $project->{'period-time:'. app()->getLocale()} }}" title="{{ $project->{'period-time:'. app()->getLocale()} }}">{{ __('web.period-time') }}:</p>
                                    <p class="projects-data">{{ $project->{'period-time:'. app()->getLocale()} }}</p>
                                </li>
                                <li class=" wow animate fadeInUp" data-wow-delay="800ms" data-wow-duration="1500ms">
                                    <p><img src="{{ asset('img/web/icons/project-sidebar-arrrow.svg') }}" alt="{{ $project->projectLink }}" title="{{ $project->projectLink }}">{{ __('web.project-link') }}:</p>
                                    <p class="h6"><a href="{{ $project->projectLink }}" target="_blank">{{ $project->projectLink }}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- ==========Project End============= -->

     
    
@endsection

@push('scripts')
  
@endpush