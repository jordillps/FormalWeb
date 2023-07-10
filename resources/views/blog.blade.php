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
            <div class="breadcrumb-area" role="navigation" aria-label="{{ __('web.blog') }}">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-sm-end justify-content-center">
                            <div class="inner-breadcrumb" role="contentinfo">
                                <h1>{{ __('web.blog') }}</h1>
                                <nav>
                                    <ol class="breadcrumb" role="navigation" aria-label="{{ __('web.blog') }}">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('web.home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ __('web.blog') }}</li>
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
    <div class="home-1-blog pt-120 mb-120">
        <div class="container">
            <div class="row g-4">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-sm-6 wow animate fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="blog-wrrap">
                            @if(count($post->getMedia('images'))>0)
                            <div class="blog-img">
                                <img src="{{ $post->getMedia('images')[0]->getUrl() }}" alt="{{ $post->{'title:'. app()->getLocale()} }}" title="{{ $post->{'title:'. app()->getLocale()} }}">
                                <div class="batch">
                                    <a class="eg-btn btn--primary btn--lg" href="{{ route('blog') }}">{{ $post->category->{'name:'. app()->getLocale()} }}</a>
                                </div>
                            </div>
                            @endif
                            <div class="blog-content">
                                <div class="publisher-date d-flex justify-content-between ">
                                    <div class="publisher">
                                        <a href="#">{{ __('web.by-author') }}</a>
                                    </div>
                                    <div class="date">
                                        @if(app()->getLocale() == 'en')
                                            <p>{{ $post->published_at->translatedFormat('Y M d') }}</p>
                                        @else
                                            <p>{{ $post->published_at->translatedFormat('d M Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <p class="h4"><a href="{{ route('blog.show', $post) }}">{{ $post->{'title:'. app()->getLocale()} }}</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $posts->links() }}

            {{-- <div class="row pt-70 wow animate fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                <nav aria-label="...">
                    <ul class="pagination justify-content-center gap-4">
                        <li class="page-item disabled">
                            <span class="page-link">
                                <svg width="31" height="16" viewBox="0 0 31 16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.76882 15.0007C8.13338 14.8885 8.33784 14.5147 8.24202 14.1422C8.21799 14.0317 7.23041 13.0281 5.29691 11.1255L2.39369 8.26588L16.0293 8.19533L29.6708 8.11892L29.8351 7.99587C29.9231 7.93141 30.0402 7.76777 30.0867 7.63358C30.1623 7.41769 30.1562 7.37111 30.0671 7.19089C30.0137 7.08043 29.8954 6.94112 29.8068 6.88324C29.6533 6.78486 29.0233 6.78177 16.0175 6.82047L2.38765 6.8677L5.23674 4.01235C6.80787 2.44422 8.12086 1.08694 8.14991 0.99943C8.29548 0.620108 8.14674 0.265375 7.78106 0.115482C7.3682 -0.0516855 7.45032 -0.121951 3.62804 3.69888C1.22444 6.09787 0.052136 7.3089 0.0290644 7.41969C0.00589212 7.50718 0.00649611 7.647 0.0304486 7.74012C0.0544513 7.84487 1.23127 9.03993 3.62598 11.4007C6.66518 14.3879 7.43366 15.1012 7.58065 15.054C7.59242 15.0539 7.67473 15.0245 7.76882 15.0007Z" />
                                </svg>
                            </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">2</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <svg width="31" height="16" viewBox="0 0 31 16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.4313 0.0952265C22.0661 0.205017 21.8592 0.57746 21.9525 0.950568C21.9758 1.06122 22.9569 2.0713 24.8779 3.98646L27.7623 6.865L14.1265 6.84643L0.484815 6.83367L0.319743 6.95565C0.231302 7.01953 0.113142 7.1824 0.0657449 7.31629C-0.0112326 7.53168 -0.00543762 7.5783 0.0824619 7.7591C0.135216 7.8699 0.252607 8.00998 0.340778 8.06844C0.493658 8.16782 1.12364 8.17503 14.1294 8.22134L27.7592 8.26319L24.8915 11.0999C23.3102 12.6577 21.9884 14.0064 21.9587 14.0937C21.8107 14.472 21.9571 14.8277 22.3218 14.98C22.7336 15.1499 22.651 15.2196 26.4982 11.4238C28.9174 9.0406 30.0976 7.83727 30.1214 7.72663C30.1451 7.63929 30.1454 7.49947 30.1221 7.4062C30.0988 7.30129 28.9298 6.09856 26.5506 3.72217C23.531 0.715166 22.7672 -0.00312928 22.6199 0.0431444C22.6081 0.0431183 22.5256 0.0720353 22.4313 0.0952265Z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
        </div>
    </div>
    <!-- ==========Blog End============= -->
     
    
@endsection

@push('scripts')
  
@endpush