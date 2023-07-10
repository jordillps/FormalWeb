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
                            <span class="card-title">{{ __('global.create-service') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('services.index') }}">{{ __('global.back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('services.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.services.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
