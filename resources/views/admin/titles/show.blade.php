@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('global.show-title') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('titles.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.page') }}:</strong>
                            </div>
                            {{ $title->page->name }}
                        </div>

                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.title') }}:</strong>
                            </div>
                            {{ $title->title }}
                        </div>

                        <div class="callout callout-primary">
                            <div>
                                <strong>{{ __('global.text') }}:</strong>
                            </div>
                            {{ $title->text }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
