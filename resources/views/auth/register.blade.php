@extends('layout')

@section('title', 'Register')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 18px; border: none; background: #fff;">
        <div class="text-center mb-4">
            <h2 style="color: var(--primary); font-weight: 700;">Register</h2>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div class="mb-3">
                <x-input-label for="name" :value="__('Name')" style="color: var(--primary);" />
                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="background: var(--surface-alt); border: 1px solid var(--accent); color: var(--primary);" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" style="color: var(--primary);" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" style="background: var(--surface-alt); border: 1px solid var(--accent); color: var(--primary);" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" style="color: var(--primary);" />
                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" style="background: var(--surface-alt); border: 1px solid var(--accent); color: var(--primary);" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Confirm Password -->
            <div class="mb-3">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" style="color: var(--primary);" />
                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" style="background: var(--surface-alt); border: 1px solid var(--accent); color: var(--primary);" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a class="text-decoration-none" style="color: var(--accent);" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
            <button type="submit" class="btn w-100" style="background: var(--primary); color: #fff; font-weight: 600; border-radius: 8px;">
                {{ __('Register') }}
            </button>
        </form>
    </div>
</div>
@endsection
