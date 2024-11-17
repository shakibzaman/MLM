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

