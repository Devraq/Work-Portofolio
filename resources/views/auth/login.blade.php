@extends('layout')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 18px; border: none; background: #fff;">
        <div class="text-center mb-4">
            <h2 style="color: var(--primary); font-weight: 700;">Login</h2>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" style="color: var(--primary);" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="background: var(--surface-alt); border: 1px solid var(--accent); color: var(--primary);" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" style="color: var(--primary);" />
                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" style="background: var(--surface-alt); border: 1px solid var(--accent); color: var(--primary);" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label" style="color: var(--primary);">{{ __('Remember me') }}</label>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                @if (Route::has('password.request'))
                    <a class="text-decoration-none" style="color: var(--accent);" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <button type="submit" class="btn w-100" style="background: var(--primary); color: #fff; font-weight: 600; border-radius: 8px;">
                {{ __('Log in') }}
            </button>
        </form>
    </div>
</div>
@endsection
