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
<div class="row">
    <div class="col-12">
        <div class="card mb-6">
            <div class="user-profile-header-banner">
                @if (isset($userData->cover_image) && !empty($userData->cover_image))
                <img src="{{ asset('storage/' . $userData->cover_image) }}" alt="Banner image" class="rounded-top">
                @else
                <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
                @endif
            </div>
            <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    @if (isset($userData->avatar) && !empty($userData->avatar))
                    <img src="{{ asset('storage/' . $userData->avatar) }}" alt="Member Profile"
                        class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img">
                    @else
                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image"
                        class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img">
                    @endif
                </div>
                <div class="flex-grow-1 mt-3 mt-lg-5">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4 class="mb-2 mt-lg-6">{{ $userData->username }} </h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                                <li class="list-inline-item d-flex gap-2 align-items-center">
                                    <i class='ti ti-calendar ti-lg'></i><span class="fw-medium"> Joined {{
                                        $userData->created_at->format('F Y') }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Header -->

<!-- Navbar pills -->
<div class="row">
    <div class="col-md-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-2 gap-lg-0">
                <li class="nav-item"><a class="nav-link active" href="{{ route('profile.index') }}"><i
                            class='ti-sm ti ti-user-check me-1_5'></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}"><i
                            class='ti-sm ti ti-pencil me-2'></i> Edit Info</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('profile.setting')}}"><i
                            class='ti-sm ti ti-settings me-2'></i> Settings</a></li>

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
            <div class="card-body">
                <small class="card-text text-uppercase text-muted small">About</small>
                <ul class="list-unstyled my-3 py-1">
                    <li class="d-flex align-items-center mb-4"><i class="ti ti-user ti-lg"></i><span
                            class="fw-medium mx-2">User Name:</span> <span>{{ $userData->username }} </span></li>
                    <li class="d-flex align-items-center mb-4"><i class="ti ti-check ti-lg"></i><span
                            class="fw-medium mx-2">Status:</span> <span>{{ $userData->status==1?'Active':'Inactive'
                            }}</span></li>

                    <li class="d-flex align-items-center mb-2"><i class="ti ti-language ti-lg"></i><span
                            class="fw-medium mx-2">Languages:</span> <span>{{ $userData->locale }}</span></li>
                </ul>
                <small class="card-text text-uppercase text-muted small">Contacts</small>
                <ul class="list-unstyled my-3 py-1">
                    <li class="d-flex align-items-center mb-4"><i class="ti ti-phone-call ti-lg"></i><span
                            class="fw-medium mx-2">Contact:</span> <span>{{ $userData->phone }}</span></li>

                    <li class="d-flex align-items-center mb-4"><i class="ti ti-mail ti-lg"></i><span
                            class="fw-medium mx-2">Email:</span> <span>{{ $userData->email }}</span></li>
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
                                <h6 class="mb-0">{{ $userData->name }}</h6>
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