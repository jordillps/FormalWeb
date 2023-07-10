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
                            <span class="card-title">{{ __('global.update-header') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('headers.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>
                    @include('flash::message')
                    <div class="card-body">
                        <form method="POST" action="{{ route('headers.update', $header->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.headers.form')

                        </form>
                        <hr>
                            <label for="document">{{ __('global.image-uploaded') }}</label>
                            <div class="row bg-uploaded-images">
                                @foreach ($header->getMedia('images') as $media)
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <form action="{{ route('headers.deleteMedia', ['media' => $media])}}" method="POST">
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
@endsection
