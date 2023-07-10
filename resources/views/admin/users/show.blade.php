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
                                <span class="card-title">{{ __('global.show-user') }}</span>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('users.index') }}">{{ __('global.back') }}</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="callout callout-primary">
                                                <div>
                                                    <strong>{{ __('global.name') }}:</strong>
                                                </div>
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="callout callout-primary">
                                                <div>
                                                    <strong>{{ __('global.role') }}:</strong>
                                                </div>
                                                {{ $user->role->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="callout callout-primary">
                                                <div>
                                                    <strong>{{ __('global.email') }}:</strong>
                                                </div>
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="callout callout-primary">
                                                <div>
                                                    <strong>{{ __('global.date-of-birth') }}:</strong>
                                                </div>
                                                {{ Carbon\Carbon::parse($user->date_birth)->format('d-m-Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(count($user->getMedia('images'))>0)
                                    <div class="col-md-3">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="{{ $user->getMedia('images')[0]->getUrl() }}" alt="User profile picture">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
