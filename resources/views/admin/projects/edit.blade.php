@extends('layouts.admin')

@section('content')
<div class="content-wrapper">    
    @include('admin.partials.header')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('global.update-project') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('projects.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>
                    @include('flash::message')
                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.update', $project) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.projects.form')

                        </form>
                        <hr>
                        <label for="document">{{ __('global.images-uploaded') }}</label>
                        <div class="row bg-uploaded-images">
                            @foreach ($project->getMedia('images') as $media)
                                <div class="col-12 col-md-4 col-lg-2 text-center">
                                    <form action="{{ route('projects.deleteMedia', ['media' => $media])}}" method="POST">
                                        {{ @method_field('DELETE')}}
                                        @csrf
                                        <img src="{{ $media->getUrl() }}" alt="" style="max-width: 100%; position:relative;">
                                        @if ($loop->index == 0)
                                            <strong>{{ __('global.home') }}</strong>
                                        @else
                                            <strong>{{ __('global.projects') }}</strong>
                                        @endif
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
