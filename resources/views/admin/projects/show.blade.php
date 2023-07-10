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
                            <span class="card-title">{{ __('global.show-project') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('projects.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.title') }}:</strong>
                            </div>
                            {{ $project->{'title:'. app()->getLocale()} }}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.text') }}:</strong>
                            </div>
                            {{ $project->{'text:'. app()->getLocale()} }}
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.published_at') }}:</strong>
                                    </div>
                                    {{ $project->published_at }}
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.category') }}:</strong>
                                    </div>
                                    {{ $project->category->name }}
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.period-time') }}:</strong>
                                    </div>
                                    {{ $project->{'period-time:'. app()->getLocale()} }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.company') }}:</strong>
                                    </div>
                                    {{ $project->company }}
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.location') }}:</strong>
                                    </div>
                                    {{ $project->location }}
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="callout callout-primary">
                                    <div>
                                        <strong>{{ __('global.project-link') }}:</strong>
                                    </div>
                                    {{ $project->projectLink }}
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-primary">
                            <strong>{{ __('global.images') }}:</strong>
                            <div class="row">
                                @foreach ($project->getMedia('images') as $media)
                                    <div class="col-12 col-md-4 col-lg-2 text-center">
                                        <img src="{{ $media->getUrl() }}" alt="" style="max-width: 100%;">
                                        @if ($loop->index == 0)
                                        <strong>{{ __('global.home') }}</strong>
                                        @endif
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
