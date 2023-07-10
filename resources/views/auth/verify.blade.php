@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">{{ __('auth.verify') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.verification-link') }}
                        </div>
                    @endif

                    {{ __('auth.before-proceding') }}
                    {{ __('auth.not-receiving-mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.click-to-another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
