@extends('layouts.admin')

@section('content')
    <div class="login-page">
        <div class="row justify-content-center">
            <div class="login-box">
                <div class="card card-info">
                    <div class="card-header">
                        <h3>{{ __('auth.login') }}</h3>
                    </div>

                    <div class="card-body login-card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('auth.email')
                                }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="{{ __('Password')
                                }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row m-0 mb-5 justify-content-between align-items-center">
                                <button type="submit" class="btn btn-block btn btn-info mb-2">
                                    {{ __('auth.login') }}
                                </button>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.rememberme') }}
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a class="btn btn-block btn-outline-primary" href="{{ route('home') }}">
                                        {{ __('global.home') }}
                                    </a>
                                </div>
                            </div>    
                            <div class="row mb-0">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('auth.forgotyourpassword') }}
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
