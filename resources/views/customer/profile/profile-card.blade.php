<div class="row">
    <div class="col-12">
        <div class="card mb-6">
            <div class="user-profile-header-banner">
                @if (isset($customer->member_cover_image) && !empty($customer->member_cover_image))
                <img src="{{ asset('storage/' . $customer->member_cover_image) }}" alt="Banner image"
                    class="rounded-top">
                @else
                <img src="{{ asset('assets/img/avatars/cover.jpg') }}" alt="Banner image" class="rounded-top">
                @endif
            </div>
            <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    @if (isset($customer->image) && !empty($customer->image))
                    <img src="{{ asset('storage/' . $customer->image) }}" alt="Member Profile"
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
                            <h4 class="mb-2 mt-lg-6">{{ $customer->name }} </h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">

                                <li class="list-inline-item d-flex gap-2 align-items-center">
                                    <i class='ti ti-map-pin ti-lg'></i><span class="fw-medium">{{
                                        $customer->city }}</span>
                                </li>
                                <li class="list-inline-item d-flex gap-2 align-items-center">
                                    <i class='ti ti-calendar ti-lg'></i><span class="fw-medium"> Joined {{
                                        $customer->created_at->format('F Y') }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary mb-1">
                            <i class='ti ti-user-check ti-xs me-2'></i>Connected
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>