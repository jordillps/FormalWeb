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
                            <span class="card-title">{{ __('global.update-service') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('services.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>
                    @include('flash::message')
                    <div class="card-body">
                        <form method="POST" action="{{ route('services.update', $service->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.services.form')

                        </form>
                        <hr>
                            <label for="document">{{ __('global.image-uploaded') }}</label>
                            <div class="row bg-uploaded-images">
                                @foreach ($service->getMedia('images') as $media)
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <form action="{{ route('services.deleteMedia', ['media' => $media])}}" method="POST">
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
