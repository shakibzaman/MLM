@extends('layouts/layoutMaster')

@section('title', 'User Profile - Profile')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
'resources/assets/vendor/libs/select2/select2.scss'
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
<!-- Page Scripts -->
@section('page-script')
@vite([
'resources/assets/js/pages-profile.js',
'resources/assets/vendor/libs/select2/select2.js',
])
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function previewImage(inputElement, previewElementId) {
            const file = inputElement.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewElementId).src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        // Event listener for profile image
        const imagePreview = document.getElementById('image_preview');
        const imageInput = document.getElementById('image_input');

        if (imagePreview) {
            imagePreview.addEventListener('click', function() {
                if (imageInput) {
                    imageInput.click();
                }
            });
        }

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                previewImage(this, 'image_preview');
            });
        }

        // Event listener for member cover image
        const coverPreview = document.getElementById('cover_image_preview');
        const coverInput = document.getElementById('cover_image_input');

        if (coverPreview) {
            coverPreview.addEventListener('click', function() {
                if (coverInput) {
                    coverInput.click();
                }
            });
        }

        if (coverInput) {
            coverInput.addEventListener('change', function() {
                previewImage(this, 'cover_image_preview');
            });
        }
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
                <li class="nav-item"><a class="nav-link active" href="{{ route('user.profile.edit') }}"><i
                            class='ti-sm ti ti-pencil me-2'></i> Edit Info</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile.setting')}}"><i
                            class='ti-sm ti ti-settings me-2'></i> Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile.referrals')}}"><i
                            class='ti-sm ti ti-link me-2'></i> Referrals</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile.kyc')}}"><i
                            class='fas fa-book me-2'></i> Kycs</a></li>

            </ul>
        </div>
    </div>
</div>
<!--/ Navbar pills -->

<!-- User Profile Content -->
<form id="editForm" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">

    <div class="row">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $customer->id }}">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-6">
                <div class="card-body">
                    <small class="card-text text-uppercase text-muted small">Profile Image</small>
                    <ul class="list-unstyled my-3 py-1">

                        <div class="mb-3 row">
                            <label for="image" class="col-form-label text-lg-end col-lg-2 col-xl-3">Member
                                Profile</label>
                            <div class="col-lg-10 col-xl-9 border">
                                <div class="mb-3 position-relative">
                                    <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                        type="file" name="image" id="image_input" style="display: none;"
                                        accept="image/*">
                                    @if (isset($customer->image) && !empty($customer->image))
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $customer->image) }}" alt="Member Profile"
                                            class="img-fluid" style="max-width: 200px; cursor: pointer;"
                                            id="image_preview">
                                        <div class="overlay-text">Member Profile Photo</div>
                                    </div>
                                    @else
                                    <img src="#" alt="Click to upload" class="img-fluid"
                                        style="max-width: 200px; cursor: pointer;" id="image_preview">
                                    @endif
                                    {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </ul>
                    <!-- New Cover Image Field -->
                    <small class="card-text text-uppercase text-muted small">Cover Image</small>
                    <ul class="list-unstyled my-3 py-1">
                        <div class="mb-3 row">
                            <label for="image" class="col-form-label text-lg-end col-lg-2 col-xl-3">Member
                                Cover</label>
                            <div class="col-lg-10 col-xl-9 border">
                                <div class="mb-3 position-relative">
                                    <input
                                        class="form-control{{ $errors->has('member_cover_image') ? ' is-invalid' : '' }}"
                                        type="file" name="member_cover_image" id="cover_image_input"
                                        style="display: none;" accept="image/*">
                                    @if (isset($customer->member_cover_image) && !empty($customer->member_cover_image))
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $customer->member_cover_image) }}"
                                            alt="Member Profile" class="img-fluid"
                                            style="max-width: 200px; cursor: pointer;" id="cover_image_preview">
                                        <div class="overlay-text">User Cover</div>
                                    </div>
                                    @else
                                    <img src="#" alt="Click to upload" class="img-fluid"
                                        style="max-width: 200px; cursor: pointer;" id="cover_image_preview">
                                    @endif
                                    {!! $errors->first('member_cover_image', '<div class="invalid-feedback">:message
                                    </div>') !!}
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
            <!--/ About User -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Activity Timeline -->
            <div class="card card-action mb-6">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0"><i class='ti ti-chart-bar ti-lg text-body me-4'></i>Update
                        Your
                        Profile
                    </h5>
                </div>
                <div class="card-body pt-3">


                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="username">Username</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $customer->name) }}" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ old('first_name', $customer->first_name) }}" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name', $customer->last_name) }}" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $customer->phone) }}" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $customer->email) }}" {{ $userSetting->email_change_status ==
                                1 ? 'readonly':'' }} required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="country_id">Country</label>
                                <select name="country_id" class="form-control select2" required>
                                    <option value="">-- Select Country --</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $customer->country_id == $country->id ?
                                        'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="city">City</label>
                                <input type="text" name="city" class="form-control"
                                    value="{{ old('city', $customer->city) }}">
                            </div>

                            <div class="form-group mb-2">
                                <label for="zip">ZIP</label>
                                <input type="text" name="zip" class="form-control"
                                    value="{{ old('zip', $customer->zip) }}">
                            </div>

                            <div class="form-group mb-2">
                                <label for="state">State</label>
                                <input type="text" name="state" class="form-control"
                                    value="{{ old('state', $customer->state) }}">
                            </div>

                            <div class="form-group mb-2">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $customer->address) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4 mb-2">
                        @if($userSetting->password_for_edit_profile == 1)
                        <button type="button" class="btn btn-primary" onclick="showPasswordModal()">Update</button>
                        @else
                        <button type="submit" class="btn btn-primary">Update</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Confirm Password</h5>

            </div>
            <div class="modal-body">
                <form id="passwordForm">
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline" onclick="togglePasswordVisibility()">
                                <i id="password-icon" class="fa fa-eye"></i> <!-- Eye icon -->
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="confirmPassword()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showPasswordModal() {
    $('#passwordModal').modal('show');
}
function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}
function confirmPassword() {
    const password = document.getElementById('password').value;

    // Send an AJAX request to verify the password
    $.ajax({
        url: '{{ route("customer.password.verify") }}', // Route to verify password
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            password: password
        },
        success: function(response) {
            if (response.success) {
                // Password is correct, submit the withdrawal form
                $('#passwordModal').modal('hide');
                document.getElementById('editForm').submit();
            } else {
                $('#passwordModal').modal('hide');

                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect Password',
                    text: 'The password you entered is incorrect. Please try again.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                // Password is incorrect, show an error message
                // alert('Incorrect password. Please try again.');
            }
        },
        error: function() {
            alert('There was an error verifying the password. Please try again later.');
        }
    });
}

</script>

<!--/ User Profile Content -->



@endsection