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
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile.setting')}}"><i
                            class='ti-sm ti ti-settings me-2'></i> Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile.referrals')}}"><i
                            class='ti-sm ti ti-link me-2'></i> Referrals</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{route('user.profile.kyc')}}"><i
                            class='fas fa-book me-2'></i> Kycs</a></li>

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
                <small class="card-text text-uppercase text-muted small">Kycs</small>
                <ul class="list-unstyled my-3 py-1 border p-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                @if(! $customer->kyc)
                                <div class="mx-auto">
                                    <form method="POST" class="needs-validation" novalidate
                                        action="{{ route('user.profile.kyc.store') }}" accept-charset="UTF-8"
                                        id="create_kyc_form" name="create_kyc_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @include ('kycs.form', [
                                        'kyc' => null,
                                        ])

                                        <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                                            <input class="p-2 rounded btn-primary" type="submit" value="Add">
                                        </div>

                                    </form>
                                </div>
                                @endif
                            </div>
                            @if($customer->kyc)
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="text-lg-end col-lg-2 col-xl-3">Document Type</dt>
                                    <dd class="col-lg-10 col-xl-9">
                                        {{ array_search($customer->kyc->document_type, config('app.document_types')) }}
                                    </dd>
                                    <dt class="text-lg-end col-lg-2 col-xl-3">Document Number</dt>
                                    <dd class="col-lg-10 col-xl-9">{{ $customer->kyc->document_number }}</dd>
                                    <dt class="text-lg-end col-lg-2 col-xl-3">Image</dt>
                                    <dd class="col-lg-10 col-xl-9">
                                        <img src="{{ asset('storage/' . $customer->kyc->image) }}" alt="kyc image"
                                            width="50%" class="border">

                                    </dd>
                                    <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
                                    <dd class="col-lg-10 col-xl-9">{{ $customer->kyc->status }}</dd>
                                    <dt class="text-lg-end col-lg-2 col-xl-3">Uploaded At</dt>
                                    <dd class="col-lg-10 col-xl-9">{{ $customer->kyc->created_at }}</dd>

                                </dl>

                            </div>
                            @endif

                        </div>
                    </div>


                </ul>
                @if($customer->status != 'approved')
                <a href="{{ route('user-kyc-edit',$customer->kyc->id) }}" class="btn btn-primary">Update</a>
                @endif
            </div>
        </div>
        <!--/ About User -->
    </div>

</div>
<!--/ User Profile Content -->
@endsection