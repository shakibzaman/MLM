@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Verify Email Basic - Pages')

@section('page-style')
<!-- Page -->
@vite('resources/assets/vendor/scss/pages/page-auth.scss')
@endsection

@section('content')
<div class="authentication-wrapper authentication-basic px-6">
    <div class="authentication-inner py-6">
        <!-- Verify Email -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-6">
                    <a href="{{ url('/') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' =>
                            "fill:#fff;"])</span>
                        <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName')
                            }}</span>
                    </a>
                </div>
                <!-- /Logo -->

                <h4 class="mb-1">Verification Email Sent ✉️</h4>

                @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('We’ve resent a verification email to your registered email address. Please check your inbox, and don’t forget to check your spam or junk folder if you don’t see it shortly.') }}
                </div>
                @else
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                  {{ __('We’ve sent a verification email to your registered email address. Please check your inbox, and don’t forget to check your spam or junk folder if you don’t see it shortly.') }}
                </div>
                @endif

                <form method="POST" action="{{ route('user.verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 my-4">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <p class="text-center mb-0">
                    {{-- <a href="{{ route('user.logout') }}" class="btn btn-secondary w-100">
                        {{ __('Log Out') }}
                    </a> --}}

                    <a class="btn btn-sm btn-danger d-flex" href="{{ route('user.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-customer').submit();">
                        <small class="align-middle">Logout</small>
                        <i class="ti ti-logout ms-2 ti-14px"></i>
                    </a>
                <form method="POST" id="logout-form-customer" action="{{ route('user.logout') }}">
                    @csrf
                </form>
                </p>
            </div>
        </div>
        <!-- /Verify Email -->
    </div>
</div>
@endsection
