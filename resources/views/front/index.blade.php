@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutFront')

@section('title', 'Landing - Front Pages')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/nouislider/nouislider.scss',
'resources/assets/vendor/libs/swiper/swiper.scss'
])
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
<style>
    .search-box {
        background: rgb(186, 133, 153);
        background: linear-gradient(0deg, rgba(186, 133, 153, 1) 36%, rgba(144, 80, 104, 1) 100%, rgba(0, 212, 255, 1) 100%);
    }

    .search-box label {
        color: #fff;
    }

    .search-box input {
        background: #9f8bd8;
        color: #fff;
    }

    .search-box select {
        background: #9f8bd8;
        color: #fff;
    }

    .search-box select:focus {
        background: #fff;
        color: #000;
    }

    .search-box input:focus {
        background: #fff;
        color: #000;
    }

    .submit-button {
        background-color: blue !important;
    }

    .level h4 {
        color: #fff;
    }
</style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
'resources/assets/vendor/libs/nouislider/nouislider.js',
'resources/assets/vendor/libs/swiper/swiper.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/front-page-landing.js'])
@endsection


@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">
    <section id="hero-animation">
        <div id="landingHero" class="section-py landing-hero position-relative">
            <img src="{{asset('assets/img/front-pages/backgrounds/hero-bg.png')}}" alt="hero background"
                class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100"
                data-speed="1" />
            <div class="container">
                <div class="hero-text-box text-center position-relative">
                    <h1 class="text-primary hero-title display-6 fw-extrabold">Estimated Earnings Calculator</h1>

                    {{-- <div class="landing-hero-btn d-inline-block position-relative">
                        <span class="hero-btn-item position-absolute d-none d-md-flex fw-medium">Join community
                            <img src="{{asset('assets/img/front-pages/icons/Join-community-arrow.png')}}"
                                alt="Join community arrow" class="scaleX-n1-rtl" /></span>
                        <a href="#landingPricing" class="btn btn-primary btn-lg">Get early access</a>
                    </div> --}}
                </div>
                <div id="heroDashboardAnimation" class="hero-animation-img">
                    <div class="income-box">
                        <form action="{{ route('income-calculate') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 card p-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="search-box  p-2">
                                                <div class="form-group mb-4">
                                                    <label for="to_user">Select Your Plan</label>
                                                    <select id="package_id" name="package_id" class="form-control">
                                                        @foreach($packages as $package)
                                                        <option value="{{$package->id }}">{{ $package->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="to_user">Select Estimated Days</label>
                                                    <select id="" name="" class="form-control">
                                                        <option>-- Select Days -- </option>
                                                        <option>3 Days</option>
                                                        <option>7 Days</option>
                                                        <option>14 Days</option>
                                                        <option>1 Month</option>
                                                        <option>3 Months</option>
                                                        <option>6 Months</option>
                                                        <option>12 Months</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="amount">Estimated User at Level 1</label>
                                                    <input type="number" id="amount" name="level1" step="1"
                                                        class="form-control" placeholder="Enter amount" value="1"
                                                        required>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="amount">Estimated User at Level 2</label>
                                                    <input type="number" id="amount" name="level2" value="1" step="1"
                                                        class="form-control" placeholder="Enter amount" required>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="amount">Estimated User at Level 3</label>
                                                    <input type="number" id="amount" name="level3" value="1" step="1"
                                                        class="form-control" placeholder="Enter amount" required>
                                                </div>
                                                <div class="form-group mb-4 text-center">
                                                    <input type="submit"
                                                        class="p-2 radious btn-primary bg-blue-900 submit-button"
                                                        value="Caldulate Now">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 ">
                                            <div class="search-box text-white p-2">


                                                <div class=" p-2 border-bottom">
                                                    <div class="level">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <p>Estimated Earnings From Basic Plan</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                @if(isset($data) )
                                                                <h4> {{ number_format($data['level1'], 2) }}</h4>
                                                                @else
                                                                <h4>N/A</h4>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" p-2 border-bottom">
                                                    <div class="level">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <p>Estimated Earnings From Pro Plan</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                @if(isset($data) )
                                                                <h4> {{ number_format($data['level2'], 2) }}</h4>
                                                                @else
                                                                <h4>N/A</h4>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" p-2 border-bottom">
                                                    <div class="level">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <p>Estimated Earnings From Elite Plan</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                @if(isset($data) )
                                                                <h4> {{ number_format($data['level3'], 2) }}</h4>
                                                                @else
                                                                <h4>N/A</h4>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" p-2 border-bottom">
                                                    <div class="level">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <p>Total Estimated Earnings</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                @if(isset($data) )
                                                                <h4> {{ number_format($data['total'], 2) }}</h4>
                                                                @else
                                                                <h4>N/A</h4>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" p-2 border-bottom">
                                                <h4 class="text-danger text-center">Note</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="level">
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="landing-hero-blank"></div>
</section>
<!-- Hero: End -->

<!-- Useful features: Start -->
{{-- --}}
<!-- Contact Us: End -->
</div>
@endsection