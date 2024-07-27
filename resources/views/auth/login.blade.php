@extends('layouts.guest')

@section('content_login')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('errorlogin'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errorlogin') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="row">
        <div class="col-lg">
            <div class="p-3">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Alamat Email -->
                    <div class="form-group">
                        <x-text-input id="email" class="form-control form-control-user" type="email" placeholder="Email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-text-input id="password" placeholder="Password" class="form-control form-control-user" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-3">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div>
                        <x-primary-button class="btn btn-primary btn-user btn-block">
                            {{ __('Login') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
