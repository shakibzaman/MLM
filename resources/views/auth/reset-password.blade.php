@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Reset Password Basic - Pages')

@section('vendor-style')
@vite([
'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
'resources/assets/js/pages-auth.js'
])
@endsection

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6">
            <!-- Reset Password -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-6">
                        <a href="{{ url('/') }}" class="app-brand-link">
                            <span class="app-brand-logo demo">@include('_partials.macros', ['height' => 20, 'withbg' =>
                                "fill: #fff;"])</span>
                            <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName')
                                }}</span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <h4 class="mb-1">Reset Password 🔒</h4>
                    <p class="mb-6"><span class="fw-medium">Your new password must be different from previously used
                            passwords</span></p>

                    <form id="formAuthentication" method="POST" action="{{ route('admin.password.store') }}">
                        @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="mb-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- New Password -->
                        <div class="mb-6 form-password-toggle">
                            <label for="password" class="form-label">New Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="password" name="password" required
                                    autocomplete="new-password" placeholder="••••••••••">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6 form-password-toggle">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="••••••••••">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary d-grid w-100 mb-6">
                            Set new password
                        </button>

                        <!-- Back to Login -->
                        <div class="text-center">
                            <a href="{{ url('auth/login-basic') }}">
                                <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                                Back to login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Reset Password -->
        </div>
    </div>
</div>
@endsection