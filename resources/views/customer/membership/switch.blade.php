@extends('layouts/layoutMaster')

@section('title',  __('switch_membership'))
@section('page-style')
  <!-- Page -->
  @vite([
  'resources/assets/vendor/libs/select2/select2.scss',
  ])
@endsection
@section('vendor-script')
  <script>
    $(document).ready(function() {
      // When the "Choose Plan" button is clicked, show the modal
      $('.open-modal').on('click', function() {
        // Get package data from button attributes
        var packageId = $(this).data('package-id');
        var packageName = $(this).data('package-name');

        // Set the modal package name and hidden input for the form
        $('#modal-package-name').text('Are you sure you want to choose the "' + packageName + '" plan?');
        $('#modal-package-id').val(packageId);

        // Show the modal
        $('#deleteModal').modal('show');
      });
    });
  </script>
 @endsection
@section('content')
  @if(auth()->guard('customer')->user()->monthly_package != null)

    <div class="card mt-5">
      <!-- Pricing Plans -->
      <div class="pb-4 rounded-top">
        <div class="container py-12 px-xl-10 px-4">
          <h3 class="text-center mb-2 mt-0 mt-md-4">Monthly Membership (Recurring Fee)</h3>
          <div class="row">
            @foreach($monthlyPackages as $package)
              <div class="col-md-4">
                <div class="card border rounded shadow-none @if($package->id == 2) border-primary @endif">
                  <div class="card-body pt-12 px-5">
                    <h4 class="card-title text-center text-capitalize mb-1">{{ $package->name }}</h4>
                    <p class="text-center mb-5">A simple start for everyone</p>
                    <div class="text-center h-px-50">
                      <div class="d-flex justify-content-center">
                        <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1">$</sup>
                        <h1 class="mb-0 text-primary">{{ $package->price }}</h1>
                      </div>
                    </div>

                    <ul class="list-group ps-6 my-5 pt-9">
                      @if($package->id == 1)
                        <li class="mb-2">30% commission on Level 1</li>
                        <li class="mb-2">5% commission on Level 2</li>
                        <li class="mb-2">1% commission on Level 3</li>
                      @elseif($package->id == 2)
                        <li class="mb-2">40% commission on Level 1</li>
                        <li class="mb-2">7% commission on Level 2</li>
                        <li class="mb-2">2% commission on Level 3</li>
                      @else
                        <li class="mb-2">50% commission on Level 1</li>
                        <li class="mb-2">10% commission on Level 2</li>
                        <li class="mb-2">3% commission on Level 3</li>
                      @endif
                      <li class="mb-2">Leaderboard</li>
                      <li class="mb-2">Giveaways + Contests</li>
                      <li class="mb-2">Coupons & More</li>
                    </ul>

                    <button @if(auth()->user()->monthly_package == $package->id) disabled @endif type="button" class="@if(auth()->user()->monthly_package == $package->id) btn-label-success @else btn-label-primary @endif btn  d-grid w-100 open-modal"
                            data-package-id="{{ $package->id }}"
                            data-package-name="{{ $package->name }}">
                      @if(auth()->user()->monthly_package == $package->id) Your Current Plan @else Switch @endif
                    </button>
                  </div>
                </div>

              </div>
            @endforeach
          </div>
        </div>
      </div>
      <!--/ Pricing Plans -->
    </div>
  @else
    <div class="alert alert-info" role="alert">
      You do not have any monthly subscription. Please buy a subscription to switch to a new subscription.
    </div>
  @endif



  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Plan Selection</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="modal-package-name">Are you sure you want to choose this plan?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form id="deleteForm" method="POST" action="{{ route('customer.enroll.monthly') }}">
            @csrf
            <input type="hidden" name="package" id="modal-package-id" value="">
            <button type="submit" class="btn btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection


