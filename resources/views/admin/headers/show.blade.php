@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('global.show-header') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('headers.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.page') }}:</strong>
                            </div>
                            {{ $header->page->name }}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.title') }}:</strong>
                            </div>
                            {{ $header->{'title:'. app()->getLocale()} }}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.text') }}:</strong>
                            </div>
                            {!! $header->{'text:'. app()->getLocale()} !!}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.image') }}:</strong>
                            </div>
                            <div class="row p-3">
                                @foreach ($header->getMedia('images') as $media)
                                    <div class="col-12 col-md-6 col-lg-3">
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
@endsection
