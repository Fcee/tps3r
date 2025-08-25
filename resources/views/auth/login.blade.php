@extends('layouts.app')

@section('content')
<style>
    .login-container {
        background: #f8fafc;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .login-card {
        width: 100%;
        max-width: 500px;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }
    .logo {
        display: block;
        margin: 0 auto 1rem auto;
        width: 80px;
    }
    .tps-title {
        text-align: center;
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #4CAF50;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <img src="{{ asset('images/logo.png') }}" alt="Logo TPS" class="logo">
        <div class="tps-title">TPS 3R SIDO MAKMUR</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Kata Sandi') }}</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" name="password" required>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
