@extends('layouts.app')

@push('styles')
    <link href='https://fonts.googleapis.com/css?family=Enriqueta:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/web/blog-details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/default.min.css') }}">
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
        <div class="breadcrumb-area" role="navigation" aria-label="{{ $post->{'title:'. app()->getLocale()} }}">
           <div class="container">
               <div class="row">
                   <div class="col-12 d-flex justify-content-sm-end justify-content-center">
                        <div class="inner-breadcrumb" role="contentinfo">
                            <h1 style="color:black;">{{ $post->{'title:'. app()->getLocale()} }}</h1>
                            <nav>
                                <ol class="breadcrumb" role="navigation" aria-label="{{ $post->{'title:'. app()->getLocale()} }}">
                                  <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('web.home') }}</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ __('web.blog') }}</li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ $post->{'title:'. app()->getLocale()} }}</li>
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

<!-- ==========Blog Start============= -->
<div class="blog-details pt-120 mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 order-lg-1 order-2 wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms" id="post-details">
                <div class="blog-dt-wrrap mb-4">
                    @if(count($post->getMedia('images'))>1)
                        <div class="blog-dt-img">
                            <img class="img-fluid" src="{{ $post->getMedia('images')[1]->getUrl() }}" alt="{{ $post->{'title:'. app()->getLocale()} }}" title="{{ $post->{'title:'. app()->getLocale()} }}">
                        </div>
                    @endif
                    
                    <div class="blog-dt-content">
                        <div class="publisher-area">
                            <ul>
                                <li><i class='bx bx-user'></i>{{ __('web.by-author') }}</li>
                                @if(app()->getLocale() == 'en')
                                    <li><i class='bx bx-calendar'></i>{{ $post->published_at->translatedFormat('Y M d') }}</li>
                                @else
                                    <li><i class='bx bx-calendar'></i>{{ $post->published_at->translatedFormat('d M Y') }}</li>
                                @endif
                                {{-- <li><i class="bi bi-chat-dots"></i>Comments (02)</li> --}}
                            </ul>
                        </div>
                        <h2>{{ $post->{'title:'. app()->getLocale()} }}</h2>
                        <p>{!! $post->{'body:'. app()->getLocale()} !!}</p>
                        <blockquote>
                            <img src="{{ asset('img/web/icons/blockquote-icon.svg') }}" alt="comillas" title="comillas">
                            <div class="blockquote-author d-flex justify-content-center">
                            </div>
                            <p>{{ $post->{'iframe:'. app()->getLocale()} }}</p>
                        </blockquote>
                        
                        {{-- <div class="blog-tag">
                            <div class="row g-3">
                                <div class="col-md-6 d-flex justify-content-md-start justify-content-center align-items-center">
                                    <p class="h4">{{ __('web.share-on') }}</p>
                                    <ul class="social-icon d-flex align-items-center flex-wrap">
                                        <li><a href="https://www.facebook.com/" aria-label="facebook"><i class="bx bxl-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/" aria-label="twitter"><i class="bx bxl-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <div class="page-navigation-area">
                            <div class="row g-4">
                                <div class="col-lg-3 d-flex ptt-20 align-items-center justify-content-center justify-content-lg-start">
                                    @if($previous != null)
                                        <a class="prev" href="{{ route('blog.show', $previous) }}">
                                            <svg width="31" height="16" viewBox="0 0 31 16" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.76882 15.0007C8.13338 14.8885 8.33784 14.5147 8.24202 14.1422C8.21799 14.0317 7.23041 13.0281 5.29691 11.1255L2.39369 8.26588L16.0293 8.19533L29.6708 8.11892L29.8351 7.99587C29.9231 7.93141 30.0402 7.76777 30.0867 7.63358C30.1623 7.41769 30.1562 7.37111 30.0671 7.19089C30.0137 7.08043 29.8954 6.94112 29.8068 6.88324C29.6533 6.78486 29.0233 6.78177 16.0175 6.82047L2.38765 6.8677L5.23674 4.01235C6.80787 2.44422 8.12086 1.08694 8.14991 0.99943C8.29548 0.620108 8.14674 0.265375 7.78106 0.115482C7.3682 -0.0516855 7.45032 -0.121951 3.62804 3.69888C1.22444 6.09787 0.052136 7.3089 0.0290644 7.41969C0.00589212 7.50718 0.00649611 7.647 0.0304486 7.74012C0.0544513 7.84487 1.23127 9.03993 3.62598 11.4007C6.66518 14.3879 7.43366 15.1012 7.58065 15.054C7.59242 15.0539 7.67473 15.0245 7.76882 15.0007Z" />
                                            </svg>
                                            {{ __('web.previous-post') }}</a>
                                    @endif
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center">
                                </div>
                                <div class="col-lg-3 d-flex mbb-20 align-items-center justify-content-center justify-content-lg-end">
                                    @if($next != null)
                                        <a class="next" href="{{ route('blog.show', $next) }}">{{ __('web.next-post') }}
                                            <svg width="31" height="16" viewBox="0 0 31 16" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22.4313 0.0952265C22.0661 0.205017 21.8592 0.57746 21.9525 0.950568C21.9758 1.06122 22.9569 2.0713 24.8779 3.98646L27.7623 6.865L14.1265 6.84643L0.484815 6.83367L0.319743 6.95565C0.231302 7.01953 0.113142 7.1824 0.0657449 7.31629C-0.0112326 7.53168 -0.00543762 7.5783 0.0824619 7.7591C0.135216 7.8699 0.252607 8.00998 0.340778 8.06844C0.493658 8.16782 1.12364 8.17503 14.1294 8.22134L27.7592 8.26319L24.8915 11.0999C23.3102 12.6577 21.9884 14.0064 21.9587 14.0937C21.8107 14.472 21.9571 14.8277 22.3218 14.98C22.7336 15.1499 22.651 15.2196 26.4982 11.4238C28.9174 9.0406 30.0976 7.83727 30.1214 7.72663C30.1451 7.63929 30.1454 7.49947 30.1221 7.4062C30.0988 7.30129 28.9298 6.09856 26.5506 3.72217C23.531 0.715166 22.7672 -0.00312928 22.6199 0.0431444C22.6081 0.0431183 22.5256 0.0720353 22.4313 0.0952265Z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @comments(['model' => $post, 'maxIndentationLevel' => 1])
            </div>
            <div class="col-lg-4 order-lg-2 order-1">
                <div class="blog-sidebar">
                    <div class="blog-widget-item wow animate fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="blog-category">
                            <div class="sidebar-widget-title">
                                <p class="h4">{{ __('web.related-posts') }}</p>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="recent-post">
                                    @if(count($relatedPosts)>0)
                                        @foreach($relatedPosts as $post)
                                            <li class="single-post d-flex align-items-center">
                                                @if(count($post->getMedia('images'))>2)
                                                    <div class="post-img">
                                                        <img src="{{ $post->getMedia('images')[2]->getUrl() }}"
                                                        alt="{{ $post->{'title:'. app()->getLocale()} }}" title="{{ $post->{'title:'. app()->getLocale()} }}">
                                                    </div>
                                                @endif
                                                <div class="post-content">
                                                    <h6><a href="{{ route('blog.show', $post) }}">{{ $post->{'title:'. app()->getLocale()} }}</a>
                                                    </h6>
                                                    @if(app()->getLocale() == 'en')
                                                        <span><i class='bx bx-calendar'></i>{{ $post->published_at->translatedFormat('Y M d') }}</span>
                                                    @else
                                                        <span><i class='bx bx-calendar'></i>{{ $post->published_at->translatedFormat('d M Y') }}</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow animate fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                        <div class="top-blog">
                            <div class="sidebar-widget-title">
                                <p class="h4">{{ __('web.category') }}</p>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="category-list">
                                    <li><a href="{{ route('blog') }}"><span>{{ $post->category->{'name:'. app()->getLocale()} }}</span><span><svg width="31" height="16" viewBox="0 0 31 16" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22.4313 0.0952265C22.0661 0.205017 21.8592 0.57746 21.9525 0.950568C21.9758 1.06122 22.9569 2.0713 24.8779 3.98646L27.7623 6.865L14.1265 6.84643L0.484815 6.83367L0.319743 6.95565C0.231302 7.01953 0.113142 7.1824 0.0657449 7.31629C-0.0112326 7.53168 -0.00543762 7.5783 0.0824619 7.7591C0.135216 7.8699 0.252607 8.00998 0.340778 8.06844C0.493658 8.16782 1.12364 8.17503 14.1294 8.22134L27.7592 8.26319L24.8915 11.0999C23.3102 12.6577 21.9884 14.0064 21.9587 14.0937C21.8107 14.472 21.9571 14.8277 22.3218 14.98C22.7336 15.1499 22.651 15.2196 26.4982 11.4238C28.9174 9.0406 30.0976 7.83727 30.1214 7.72663C30.1451 7.63929 30.1454 7.49947 30.1221 7.4062C30.0988 7.30129 28.9298 6.09856 26.5506 3.72217C23.531 0.715166 22.7672 -0.00312928 22.6199 0.0431444C22.6081 0.0431183 22.5256 0.0720353 22.4313 0.0952265Z" />
                                    </svg></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow animate fadeInUp" data-wow-delay="500ms" data-wow-duration="1500ms">
                        <div class="tag-area">
                            <div class="sidebar-widget-title">
                                <p class="h4">{{ __('web.follow-me') }}</p>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="sidebar-social-list gap-4">
                                    <li><a href="{{ $setting->facebook_url }}" aria-label="facebook" target="blank">
                                        <span class="visually-hidden">Facebook</span>
                                        <i alt="logo facebook" class="bx bxl-facebook"></i></a></li>
                                    <li><a href="{{ $setting->twitter_url }}" aria-label="twitter" target="blank">
                                        <span class="visually-hidden">Twitter</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><g fill="#ffffff"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></g></svg></a></li>
                                    <li><a href="{{ $setting->linkedin_url }}" aria-label="linkedin" target="blank">
                                        <span class="visually-hidden">Linkedin</span>
                                        <i alt="logo linkedin" class="bx bxl-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow animate fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="tag-area">
                            <div class="sidebar-widget-title">
                                <p class="h4">{{ __('web.post-tag') }}</p>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="post-tag-list gap-3 d-flex align-items-center flex-wrap">
                                    @foreach ($tags as $tag)
                                        <li><a href="{{ route('blog') }}">{{ $tag->name }}</a></li> 
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==========Blog End============= -->


@endsection

@push('scripts')


<script src="{{ asset('js/web/highlight.min.js') }}"></script>
<script>hljs.highlightAll();</script>
  
@endpush