@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('global.show-service') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('services.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.title') }}:</strong>
                            </div>
                            {{ $service->{'title:'. app()->getLocale()} }}
                        </div>
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.text') }}:</strong>
                            </div>
                            {{ $service->{'text:'. app()->getLocale()} }}
                        </div>
                        <div class="callout callout-primary">
                            <strong>{{ __('global.body') }}:</strong>
                                {!! $service->{'body:'. app()->getLocale()} !!}
                        </div>   
                        <div class="callout callout-primary">
                            <strong>{{ __('global.image') }}:</strong>
                            <div class="row p-3">
                                @foreach ($service->getMedia('images') as $media)
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <img src="{{ $media->getUrl() }}" alt="" style="max-width: 100%;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="callout callout-primary">
                            <strong>{{ __('global.icons') }}:</strong>
                            <div>
                                <span class="ico-circle"><img src="{{ asset('img/web/icons/'.$service->icon) }}"></span>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
