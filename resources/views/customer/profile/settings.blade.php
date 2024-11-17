@extends('layouts/layoutMaster')

@section('title', 'User Profile - Profile')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss'
])
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-profile.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/pages-profile.js'])
<script>
    // Toggle password visibility with eye icon
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const passwordField = document.querySelector(this.getAttribute('data-target'));
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection

@section('content')
<!-- Header -->
@include('customer/profile/profile-card')

<!--/ Header -->

<!-- Navbar pills -->
<div class="row">
    <div class="col-md-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-2 gap-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('user.profile.show') }}"><i
                            class='ti-sm ti ti-user-check me-1_5'></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.profile.edit') }}"><i
                            class='ti-sm ti ti-pencil me-2'></i> Edit Info</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{route('user.profile.setting')}}"><i
                            class='ti-sm ti ti-settings me-2'></i> Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile.referrals')}}"><i
                            class='ti-sm ti ti-link me-2'></i> Referrals</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile.kyc')}}"><i
                            class="fas fa-book me-2"></i> Kycs</a></li>

            </ul>
        </div>
    </div>
</div>
<!--/ Navbar pills -->

<!-- User Profile Content -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <!-- About User -->
        <div class="card mb-6">
            <div class="card-body">
                <small class="card-text text-uppercase text-muted small">Account settings</small>
                <ul class="list-unstyled my-3 py-1 border p-2">
                    <form action="{{ route('user.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12 p-4">
                                <!-- New Password -->
                                <div class="form-group mb-2">
                                    <label for="password">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control"
                                            required>
                                        <button type="button" class="btn btn-outline-secondary toggle-password"
                                            data-target="#password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <!-- Confirm New Password -->
                                <div class="form-group mb-4">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" required>
                                        <button type="button" class="btn btn-outline-secondary toggle-password"
                                            data-target="#password_confirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @if($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </ul>
                <small class="card-text text-uppercase text-muted small mb-4">Settings</small>
                <ul class="list-unstyled border p-4">
                    <form id="2fa-form" action="{{ route('user.2fa.toggle') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="2fa-toggle">Two-Step Authentication (2FA)</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="2fa-toggle"
                                    name="two_fa_enabled" {{ $customer->auth_2fa ? 'checked' : '' }}
                                onchange="document.getElementById('2fa-form').submit();">
                                <label class="custom-control-label" for="2fa-toggle">
                                    {{ $customer->auth_2fa ? 'Disable' : 'Enable' }} 2FA
                                </label>
                            </div>
                        </div>
                    </form>
                </ul>
                <small class="card-text text-uppercase text-muted small">Privacy and security</small>
                <ul class="list-unstyled my-3 py-1 border p-2">
                    <li class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Clear browsing data</h6>
                            <p>Clear history, cookies, cache, and more</p>
                        </div>
                        <a href="/clear-cache" class=""><i class="ti ti-trash ti-md"></i></a>
                    </li>
                </ul>

            </div>
        </div>
        <!--/ About User -->
    </div>

</div>
<!--/ User Profile Content -->
@endsection