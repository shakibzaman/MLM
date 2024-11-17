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
                <li class="nav-item"><a class="nav-link active" href="{{route('user.profile.referrals')}}"><i
                            class='ti-sm ti ti-link me-2'></i> Referrals</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile.kyc')}}"><i
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
                <small class="card-text text-uppercase text-muted small">Account settings</small>
                <ul class="list-unstyled my-3 py-1 border p-2">


                    <div class="row">
                        <div class="col-md-12">
                            @if ($subscribers->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Joining date</th>
                                        <th>Lifetime package</th>
                                        <th>Monthly date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribers as $subscriber)
                                    <tr>
                                        <td>{{ $subscriber->name }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>{{ $subscriber->phone }}</td>
                                        <td>{{ $subscriber->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $subscriber->lifetimePackage->name ?? 'No package' }}</td>
                                        <td>{{ $subscriber->monthlyPackage->name ?? 'No package' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $subscribers->links('pagination') !!}
                            @else
                            <p>No subscribers yet.</p>
                            @endif

                        </div>
                    </div>


                </ul>
            </div>
        </div>
        <!--/ About User -->
    </div>

</div>
<!--/ User Profile Content -->
@endsection