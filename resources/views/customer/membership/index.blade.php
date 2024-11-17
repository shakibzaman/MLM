@extends('layouts/layoutMaster')

@section('title', 'Membership plan')
@section('page-style')
  <style>
    .clock {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translateX(-50%) translateY(-50%);
      color: #17D4FE;
      font-size: 60px;
      font-family: Orbitron;
      letter-spacing: 7px;

    }
    .clock-warpper{
      position: relative;
      min-height: 70px;
      margin-bottom: 20px;
    }
  </style>
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


      $('.open-monthly-modal').on('click', function() {
        // Get package data from button attributes
        var packageId = $(this).data('package-id');
        var packageName = $(this).data('package-name');

        // Set the modal package name and hidden input for the form
        $('#modal-monthly-package-name').text('Are you sure you want to choose the "' + packageName + '" plan?');
        $('#modal-monthly-package-id').val(packageId);

        // Show the modal
        $('#monthlyModal').modal('show');
      });
    });
  </script>

  <script>
    @php

      $accountCreationTime = auth()->guard('customer')->user()->created_at;

        $endTime = (clone $accountCreationTime)->addHours(72);

        // Calculate remaining time in seconds
        if (now()->greaterThanOrEqualTo($endTime)) {
            $remainingTime = 0; // Time is up
        } else {
            $correnttime = now();
            $remainingTime = $correnttime->diffInSeconds($endTime); // Remaining time in seconds
        }
    @endphp

    let remainingTime = Math.floor(@json($remainingTime)); // This is the remaining time in seconds

    function startCountdown(duration, display) {
      let timer = duration, hours, minutes, seconds;
      console.log(timer);
      const interval = setInterval(function () {
        if (timer >= 0) {
          hours = Math.floor(timer / 3600);
          minutes = Math.floor((timer % 3600) / 60);
          seconds = timer % 60;

          // Format hours, minutes, and seconds to always show two digits
          hours = hours < 10 ? "0" + hours : hours;
          minutes = minutes < 10 ? "0" + minutes : minutes;
          seconds = seconds < 10 ? "0" + seconds : seconds;

          display.textContent = hours + ":" + minutes + ":" + seconds;

          timer--;
        } else {
          // If timer is over, show 00:00:00 and stop the interval
          display.textContent = "00:00:00";
          clearInterval(interval);
        }
      }, 1000);
    }

    window.onload = function () {
      const display = document.getElementById('countdown');
      startCountdown(remainingTime, display);
    };


  </script>
@endsection
@section('content')

  <div class="card">
    <!-- Pricing Plans -->
    <div class="pb-4 rounded-top">
      <div class="container py-12 px-xl-10 px-4">
        <h3 class="text-center mb-2 mt-0 mt-md-4">Pricing Plans</h3>
        <h1 class="text-center pricing-table-title">Take Your Earnings To The Next Level</h1>
        <h5 class="text-center pricing-table-subtitle mb-5">Enroll within 72 hrs to get discount.</h5>
        @if(auth()->guard('customer')->user()->lifetime_package == null)
          <div class="row">
            <div class="col-md-12">
              <div class="clock-warpper">
                <div id="countdown" class="clock"></div>
              </div>
            </div>
          </div>
        @endif
        <div class="row">
          @foreach($packages as $package)
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

                  <button @if(auth()->user()->lifetime_package == $package->id || (auth()->user()->lifetime_package && !isset($upgrade))) disabled @endif type="button" class="@if(auth()->user()->lifetime_package == $package->id) btn-label-success @else btn-label-primary @endif btn  d-grid w-100 open-modal"
                          data-package-id="{{ $package->id }}"
                          data-package-name="{{ $package->name }}">
                    @if(auth()->user()->lifetime_package == $package->id) Your Current Plan @else @if(isset($upgrade))Upgrade @else Buy now @endif @endif
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

  @if(!isset($lifetime))
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

                  <button @if(auth()->user()->monthly_package) disabled @endif type="button" class="@if(auth()->user()->monthly_package == $package->id) btn-label-success @else btn-label-primary @endif btn  d-grid w-100 open-monthly-modal"
                          data-package-id="{{ $package->id }}"
                          data-package-name="{{ $package->name }}">
                    @if(auth()->user()->monthly_package == $package->id) Your Current Plan @else Buy now @endif
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
  <div class="card mt-5">
    <div class="card-header"><h3>FAQ on Membership:</h3></div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h5>Can I change my lifetime membership package?</h5>
          <p>Absolutely! You can adapt and optimize your lifetime membership package at any time.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>What does the lifetime activation package price include?</h5>
          <p>Each package opens the gateway to our exclusive incredible income program, where you can watch
            your earnings soar to new heights.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Can I change my lifetime membership package?</h5>
          <p>Absolutely! You can adapt and optimize your lifetime membership package at any time.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>What is the referral commission structure for each package?</h5>
          <p>For the $20 package, you earn 36% commission on the first level, 5% on the second
            level, and 1% on the third level. For the $58 package, it's 40%, 7%, and 2%; for the $98
            package, it's 50%, 10%, and 3%.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Is there a monthly subscription fee & how much?</h5>
          <p>Although a monthly subscription fee is not mandatory, it’s the strong foundation for unlocking
            powerful and effortless earnings—even while you're catching some Z's! The monthly subscription fee
            serves as a strong, unwavering key to uninterrupted income. The costs are:</p>
          <p>$5 for the $20 package</p>
          <p>$15 for the $58 package</p>
          <p>$25 for the $98 package</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>What's the Difference Between Account Activation and Monthly Income Activation?</h5>
          <p>Account activation is a one-time investment for perpetual opportunity, while monthly income
            activation ensures ongoing earnings.</p>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <b>Did you find all the answers you were looking for on this topic? If not, click here for more information.</b>
    </div>
  </div>
  @endif
  <!-- Confirmation Modal -->
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
          <form id="deleteForm" method="POST" action="{{ route('customer.enroll.lifetime') }}">
            @csrf
            <input type="hidden" name="package" id="modal-package-id" value="">
            <button type="submit" class="btn btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Monthly Modal -->

  <div class="modal fade" id="monthlyModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Plan Selection</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="modal-monthly-package-name">Are you sure you want to choose this plan?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form id="deleteForm" method="POST" action="{{ route('customer.enroll.monthly') }}">
            @csrf
            <input type="hidden" name="package" id="modal-monthly-package-id" value="">
            <button type="submit" class="btn btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- jQuery and Bootstrap JS -->


@endsection

