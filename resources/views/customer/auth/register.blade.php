@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Multi Steps Sign-up - Pages')

@section('vendor-style')+
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.5/dist/sweetalert2.min.css">
@vite([
'resources/assets/vendor/libs/bs-stepper/bs-stepper.scss',
'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
'resources/assets/vendor/libs/select2/select2.scss',
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
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
'resources/assets/vendor/libs/bs-stepper/bs-stepper.js',
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.5/dist/sweetalert2.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    window.passwordConstraints = {
            min: {{ $minLength }},
            max: {{ $maxLength }}
        };
    $(document).ready(function () {
        window.passwordConstraints = {
            min: {{ $minLength }},
            max: {{ $maxLength }}
        };
        // const minPasswordLength = {{ $minLength }};
        // const maxPasswordLength = {{ $maxLength }};
        // console.log(minPasswordLength);
        // Handle form submission
        $('#multiStepsFormSubmit').on('click', function (e) {
            e.preventDefault();

            // Collect form data
            let formData = new FormData($('#multiStepsForm')[0]);

            $.ajax({
                url: "{{ route('member.register') }}", // Route defined in web.php
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    let timerInterval;
                    Swal.fire({
                        title: "Registering!",
                        html: "You will Redirecting <b></b> Soon.",
                        timer: 6000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                        }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log("I was closed by the timer");
                        }
                    });
                },
                success: function (response) {
                    console.log(response);
                    if(response.status==200){
                        Swal.fire({
                            title: "You are registered!",
                            text: "Success!",
                            icon: "success"
                            });
                        window.location.href = "{{ route('customer.dashboard') }}";
                    }else{
                        alert('Regitration Failled');
                    }
                    // Handle success - maybe navigate to a success page or show a message
                    // alert("Form submitted successfully!");
                },
                complete: function() {
                    $('#loader').addClass('hidden'); // Hide the loader after the request is complete
                },
                error: function (xhr) {
                    // Handle error
                    $('#loader').addClass('hidden'); // Hide loader on error
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        // Display error messages dynamically
                        alert(errors[field]);
                    }
                }
            });
        });
    });
</script>
@vite([
'resources/assets/js/pages-auth-multisteps.js'
])
@endsection

@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="authentication-wrapper authentication-cover authentication-bg">
    <!-- Logo -->
    <a href="{{url('/')}}" class="app-brand auth-cover-brand">
        @if(isset($globalSettings->site_logo))
        <span class="app-brand-logo" style="width: 10%">
            <img src="{{ asset('storage/' . $globalSettings->site_logo) }}" style="width: 100%">

        </span>
        @else
        <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill: #fff;"])</span>
        <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
        @endif
    </a>
    <!-- /Logo -->
    <div class="authentication-inner row">

        <!-- Left Text -->
        <div
            class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-5 auth-cover-bg-color position-relative auth-multisteps-bg-height">
            <img src="{{ asset('assets/img/illustrations/auth-register-multisteps-illustration.png') }}"
                alt="auth-register-multisteps" class="img-fluid" width="280">

            <img src="{{ asset('assets/img/illustrations/auth-register-multisteps-shape-'.$configData['style'].'.png') }}"
                alt="auth-register-multisteps" class="platform-bg"
                data-app-light-img="illustrations/auth-register-multisteps-shape-light.png"
                data-app-dark-img="illustrations/auth-register-multisteps-shape-dark.png">
        </div>
        <!-- /Left Text -->

        <!--  Multi Steps Registration -->
        <div class="d-flex col-lg-8 align-items-center justify-content-center authentication-bg p-5">
            <div class="w-px-700">
                <div id="multiStepsValidation" class="bs-stepper border-none shadow-none mt-5">
                    <div class="bs-stepper-header border-none pt-12 px-0">
                        <div class="step" data-target="#accountDetailsValidation">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle"><i class="ti ti-file-analytics ti-md"></i></span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Account</span>
                                    <span class="bs-stepper-subtitle">Account Details</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i class="ti ti-chevron-right"></i>
                        </div>
                        <div class="step" data-target="#personalInfoValidation">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle"><i class="ti ti-user ti-md"></i></span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Personal</span>
                                    <span class="bs-stepper-subtitle">Enter Information</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i class="ti ti-chevron-right"></i>
                        </div>
                        <div class="step" data-target="#billingLinksValidation">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle"><i class="ti ti-credit-card ti-md"></i></span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Package</span>
                                    <span class="bs-stepper-subtitle">Package Details</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content px-0">
                        <form id="multiStepsForm" onSubmit="return false">
                            @csrf
                            <input type="hidden" name="ref" value="{{ request()->query('ref') }}" />
                            <!-- Account Details -->
                            <div id="accountDetailsValidation" class="content">
                                <div class="content-header mb-6">
                                    <h4 class="mb-0">Account Information</h4>
                                    <p class="mb-0">Enter Your Account Details</p>
                                </div>
                                <div class="row g-6">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="multiStepsUsername">Username</label>
                                        <input type="text" name="multiStepsUsername" id="multiStepsUsername"
                                            class="form-control" placeholder="johndoe" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="multiStepsEmail">Email</label>
                                        <input type="email" name="multiStepsEmail" id="multiStepsEmail"
                                            class="form-control" placeholder="john.doe@email.com"
                                            aria-label="john.doe" />
                                    </div>
                                    <div class="col-sm-6 form-password-toggle">
                                        <label class="form-label" for="multiStepsPass">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="multiStepsPass" name="multiStepsPass"
                                                class="form-control"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="multiStepsPass2" />
                                            <span class="input-group-text cursor-pointer" id="multiStepsPass2"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-password-toggle">
                                        <label class="form-label" for="multiStepsConfirmPass">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="multiStepsConfirmPass"
                                                name="multiStepsConfirmPass" class="form-control"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="multiStepsConfirmPass2" />
                                            <span class="input-group-text cursor-pointer" id="multiStepsConfirmPass2"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-label-secondary btn-prev" disabled> <i
                                                class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next"> <span
                                                class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                            <i class="ti ti-arrow-right ti-xs"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- Personal Info -->
                            <div id="personalInfoValidation" class="content">
                                <div class="content-header mb-6">
                                    <h4 class="mb-0">Personal Information</h4>
                                    <p class="mb-0">Enter Your Personal Information</p>
                                </div>
                                <div class="row g-6">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="multiStepsFirstName">First Name</label>
                                        <input type="text" id="multiStepsFirstName" name="multiStepsFirstName"
                                            class="form-control" placeholder="John" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="multiStepsLastName">Last Name</label>
                                        <input type="text" id="multiStepsLastName" name="last_name" class="form-control"
                                            placeholder="Doe" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="multiStepsMobile">Mobile</label>
                                        <div class="input-group">
                                            <input type="text" id="multiStepsMobile" name="phone"
                                                class="form-control multi-steps-mobile" placeholder="202 555 0111" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="multiStepsZipcode">Zip code</label>
                                        <input type="text" id="multiStepsZipcode" name="zip"
                                            class="form-control multi-steps-pincode" placeholder="Postal Code"
                                            maxlength="6" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="multiStepsAddress">Address</label>
                                        <input type="text" id="multiStepsAddress" name="multiStepsAddress"
                                            class="form-control" placeholder="Address" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="multiStepsArea">Country</label>
                                        <select id="multiStepsCountry" class="select2 form-select"
                                            data-allow-clear="true" name="country_id">
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="multiStepsCity">City</label>
                                        <input type="text" id="multiStepsCity" name="city" class="form-control"
                                            placeholder="Jackson" />

                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="multiStepsState">State</label>
                                        <input type="text" id="multiStepsState" name="state" class="form-control"
                                            placeholder="State" />
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-label-secondary btn-prev"> <i
                                                class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next"> <span
                                                class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                            <i class="ti ti-arrow-right ti-xs"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- Billing Links -->
                            <div id="billingLinksValidation" class="content">
                                <div class="content-header mb-6">
                                    <h4 class="mb-0">Select Plan</h4>
                                    <p class="mb-0">Select plan as per your requirement</p>
                                </div>
                                <!-- Custom plan options -->
                                <div class="row gap-md-0 gap-4 mb-12">
                                    <div class="col-md">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="basicOption">
                                                <span class="custom-option-body">
                                                    <span class="d-block mb-2 h5">Basic</span>
                                                    <span>A simple start for start ups & Students</span>
                                                    <span class="d-flex justify-content-center mt-2">
                                                        <sup class="text-primary h6 fw-normal pt-2 mb-0">$</sup>
                                                        <span class="fw-medium h3 text-primary mb-0">20</span>
                                                        <sub class="h6 fw-normal mt-3 mb-0 text-muted">/month</sub>
                                                    </span>
                                                </span>
                                                <input name="lifetime_package" class="form-check-input" type="radio"
                                                    value="1" id="basicOption" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="standardOption">
                                                <span class="custom-option-body">
                                                    <span class="d-block mb-2 h5">Moderate</span>
                                                    <span>For small to medium businesses</span>
                                                    <span class="d-flex justify-content-center mt-2">
                                                        <sup class="text-primary h6 fw-normal pt-2 mb-0">$</sup>
                                                        <span class="fw-medium h3 text-primary mb-0">58</span>
                                                        <sub class="h6 fw-normal mt-3 mb-0 text-muted">/month</sub>
                                                    </span>
                                                </span>
                                                <input name="lifetime_package" class="form-check-input" type="radio"
                                                    value="2" id="standardOption" checked />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content"
                                                for="enterpriseOption">
                                                <span class="custom-option-body">
                                                    <span class="d-block mb-2 h5">Advance</span>
                                                    <span>Solution for enterprise & organizations</span>
                                                    <span class="d-flex justify-content-center mt-2">
                                                        <sup class="text-primary h6 fw-normal pt-2 mb-0">$</sup>
                                                        <span class="fw-medium h3 text-primary mb-0">98</span>
                                                        <sub class="h6 fw-normal mt-3 mb-0 text-muted">/year</sub>
                                                    </span>
                                                </span>
                                                <input name="lifetime_package" class="form-check-input" type="radio"
                                                    value="3" id="enterpriseOption" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between mt-5">
                                        <button class="btn btn-label-secondary btn-prev"> <i
                                                class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button type="submit" class="btn btn-success btn-next btn-submit"
                                            id="multiStepsFormSubmit">Submit</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Multi Steps Registration -->
    </div>
</div>

<script type="module">
    // Check selected custom option
  window.Helpers.initCustomOptionCheck();
</script>
@endsection