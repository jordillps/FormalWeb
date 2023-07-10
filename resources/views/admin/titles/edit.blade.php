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
                            <span class="card-title">{{ __('global.update-title') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('titles.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>

                    @include('flash::message')
                    <div class="card-body">
                        <form method="POST" action="{{ route('titles.update', $title->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.titles.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
