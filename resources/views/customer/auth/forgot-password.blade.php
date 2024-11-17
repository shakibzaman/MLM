@php
$customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

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
            <!-- Forgot Password -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-6">
                        <a href="{{url('/')}}" class="app-brand-link">
                            @isset($globalSetting)
                            <span class="mx-auto">
                                <img class="app-brand-logo mx-auto"
                                    src="{{ asset('storage/' . $globalSetting->site_logo) }}" width="70%">
                            </span>

                            @else
                            <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' =>
                                "fill: #fff;"])</span>
                            <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName')
                                }}</span>
                            @endisset

                        </a>
                    </div>
                    <!-- /Logo -->

                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- Title -->
                    <h4 class="mb-1">Member ! Forgot Password? 🔒</h4>
                    <p class="mb-6">Enter your email and we'll send you instructions to reset your password.</p>

                    <!-- Forgot Password Form -->
                    <form id="formAuthentication" class="mb-6" action="{{ route('user.password.email') }}"
                        method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                placeholder="Enter your email" required autofocus>
                            @if ($errors->has('email'))
                            <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                    </form>

                    <div class="text-center">
                        <a href="{{url('/login')}}" class="d-flex justify-content-center">
                            <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>
@endsection