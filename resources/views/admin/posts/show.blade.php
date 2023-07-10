@extends('layouts.admin')

@section('content')
<div class="content-wrapper">    
    @include('admin.partials.header')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('global.show-post') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('posts.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.title') }}:</strong>
                            </div>
                            {{ $post->{'title:'. app()->getLocale()} }}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>Url:</strong>
                            </div>
                            {{ $post->{'url:'. app()->getLocale()} }}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.excerpt') }}:</strong>
                            </div>
                            {{ $post->{'excerpt:'. app()->getLocale()} }}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.iframe') }}:</strong>
                            </div>
                            {{ $post->{'iframe:'. app()->getLocale()} }}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.body') }}:</strong>
                            </div>
                            {!! $post->{'body:'. app()->getLocale()} !!}
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.published_at') }}:</strong>
                                    </div>
                                    {{ $post->published_at }}
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.isPublished') }}:</strong>
                                    </div>
                                    {{ $post->isPublished }}
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.author') }}:</strong>
                                    </div>
                                    {{ $post->user->name }}
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.category') }}:</strong>
                                    </div>
                                    {{ $post->category->{'name:'. app()->getLocale()} }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.tags') }}:</strong>
                                    </div>
                                    @foreach ($post->tags as $tag)
                                    <button type="button" class="btn btn btn-warning mr-3">{{ $tag->name }}</button>     
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-primary">
                            <strong>{{ __('global.images') }}:</strong>
                            <div class="row">
                                @foreach ($post->getMedia('images') as $media)
                                    <div class="col-12 col-md-4 col-lg-2">
                                        <img src="{{ $media->getUrl() }}" alt="" style="max-width: 100%;">
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
