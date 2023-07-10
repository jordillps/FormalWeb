@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('global.update-setting') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('settings.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>
                    @include('flash::message')
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.update', $setting) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.settings.form')

                        </form>
                        <hr>
                        <label for="document">{{ __('global.logos-uploaded') }}</label>
                        <div class="row bg-uploaded-images">
                            @foreach ($setting->getMedia('images') as $media)
                                <div class="col-12 col-md-4 col-lg-2">
                                    <form action="{{ route('settings.deleteMedia', ['media' => $media])}}" method="POST">
                                        {{ @method_field('DELETE')}}
                                        @csrf
                                        <img src="{{ $media->getUrl() }}" alt="" style="max-width: 100%; position:relative;">
                                        <button class="btn btn-danger" style="position:absolute; top:0; left:0;"><i class="far fa-trash-alt xs"></i></button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
