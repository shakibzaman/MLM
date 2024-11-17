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
                <li class="nav-item"><a class="nav-link active" href="{{ route('user.profile.show') }}"><i
                            class='ti-sm ti ti-user-check me-1_5'></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.profile.edit') }}"><i
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
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-6">
            <div class="border">
                <div class="row text-center p-2">
                    <div class="col-md-6 ">
                        <p>{{ $commission['total_commission'] }}</p>
                        <p>Total Commission</p>

                    </div>
                    <div class="border-left col-md-6">
                        <p>{{ $withdraws }}</p>
                        <p>Total Payout</p>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <small class="card-text text-uppercase text-muted small">About</small>
                <ul class="list-unstyled my-3 py-1">
                    <li class="d-flex align-items-center mb-4"><i class="ti ti-user ti-lg"></i><span
                            class="fw-medium mx-2">Full Name:</span> <span>{{ $customer->first_name }} {{
                            $customer->last_name }}</span></li>
                    <li class="d-flex align-items-center mb-4"><i class="ti ti-check ti-lg"></i><span
                            class="fw-medium mx-2">Status:</span> <span>{{ $customer->status==1?'Active':'Inactive'
                            }}</span></li>
                    {{-- <li class="d-flex align-items-center mb-4"><i class="ti ti-crown ti-lg"></i><span
                            class="fw-medium mx-2">Role:</span> <span>Developer</span></li> --}}
                    <li class="d-flex align-items-center mb-4"><i class="ti ti-flag ti-lg"></i><span
                            class="fw-medium mx-2">Country:</span> <span>{{
                            $customer->country?$customer->country->name:'N/A'}}</span></li>
                    <li class="d-flex align-items-center mb-2"><i class="ti ti-language ti-lg"></i><span
                            class="fw-medium mx-2">Languages:</span> <span></span></li>
                </ul>
                <ul class="list-unstyled my-3 py-1">
                    <div class="border">
                        <div class="row text-center p-2">
                            <div class="col-md-6 ">
                                <i class="ti ti-user ti-lg text-success"></i>
                                <h4><b>{{ $customer->subscribers->count() }}</b> </h4>
                                <p>Referrals</p>

                            </div>
                            <div class="border-left col-md-6">
                                <i class="fas fa-dollar-sign"></i>
                                <h4><b>{{ $customer->balance }}</b></h4>
                                <p>Balance</p>

                            </div>
                        </div>
                    </div>
                </ul>
                <small class="card-text text-uppercase text-muted small">Contacts</small>
                <ul class="list-unstyled my-3 py-1">
                    <li class="d-flex align-items-center mb-4"><i class="ti ti-phone-call ti-lg"></i><span
                            class="fw-medium mx-2">Contact:</span> <span>{{ $customer->phone }}</span></li>

                    <li class="d-flex align-items-center mb-4"><i class="ti ti-mail ti-lg"></i><span
                            class="fw-medium mx-2">Email:</span> <span>{{ $customer->email }}</span></li>
                </ul>
            </div>
        </div>
        <!--/ About User -->
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Activity Timeline -->
        <div class="card card-action mb-6">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0"><i class='ti ti-chart-bar ti-lg text-body me-4'></i>Your Activity
                    History
                </h5>
            </div>
            <div class="card-body pt-3">
                <ul class="timeline mb-0">
                    @foreach($activities as $activity)

                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-3">
                                <h6 class="mb-0">{{ $customer->name }}</h6>
                                <small class="text-muted">{{ $activity->created_at->format('d M Y') }}
                                </small>
                            </div>
                            <p class="mb-2">
                                {{ $activity->description }}
                            </p>
                        </div>
                    </li>
                    @endforeach

                </ul>
                {!! $activities->links('pagination') !!}
            </div>
        </div>
    </div>
</div>
<!--/ User Profile Content -->
@endsection