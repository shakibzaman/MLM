@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

{{-- @section('content_header')
<h1>Dashboard</h1>
@endsection --}}
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
@section('content')

  <script>
    @php

      $accountCreationTime = $user->created_at;

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
    @if($remainingTime != 0)
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
    @endif

  </script>

  <div class="row">
    <div class="col-md-12">
      <h2>Dashboard Overview</h2>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-3">
            <div class="card-body">
              <h3>Wallet Overview</h3>
              <div class="d-flex">
                <div class="flex-grow-1 w-50 balanace border-2 border-primary rounded border text-center">
                  <p>Account Balance : <br /> {{ $user->balance }}</p>
                </div>
                <div class="flex-grow-1 w-50">
                <div class="blanace-todat">
                  <p>Today’s Income : {{ $todaysincone }}</p>
                </div>
                <div class="blanace-todat">
                <p>Earning This Month : {{ $monthlyincone }}</p>
              </div>
                </div>
              </div>
              <div class="payments-details">
                Paid

                $ {{ $paidwidthfraw }}

                Pending

                $ {{ $pendingwidthfraw }}
                <a href="{{ route('user.profile.show') }}">View Commission Wallet</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card mb-3 text-center">
            <div class="card-body">
              <a href="{{ route('user.deposits.deposit.create') }}">Add Fund</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card mb-3 text-center">
            <div class="card-body">
              <a href="{{ route('customer.withdraw.create') }}">Withdraw</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-3">
            <div class="card-body">
              <h3>How to get started</h3>
              <div>
                <h4>Deposit Fund</h4>
                <p>Deposit some fund to activate a membership.</p>
              </div>
              <div>
                <h4>Buy Membership</h4>
                <p>Purchase membership and make referrals.</p>
              </div>
              <div>
                <h4>Enjoy Earning</h4>
                <p>Enjoy your happing and sweet earning with us</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="card mb-3 text-center">
        <div class="card-body">
          <p>Point Wallet</p>
          <span>{{ $user->reward_point }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3 text-center">
        <div class="card-body">
          <p>Total Referrals</p>
          <span>{{ $totalref }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3 text-center">
        <div class="card-body">
          <p>Direct Referrals</p>
          <span>{{ $directref }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3 text-center">
        <div class="card-body">
          <p>Indirect Referrals</p>
          <span>{{ $indirectref }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3 text-center">
        <div class="card-body">
          <p>Monthly Active</p>
          {{ $monthlyactive }}
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3 text-center">
        <div class="card-body">
          <p>Active Level 1</p>
          <span>{{ $labelsub1 }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3 text-center">
        <div class="card-body">
          <p>Active Level 2</p>
          <span>{{ $labelsub2 }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3 text-center">
        <div class="card-body">
          <p>Active Level 3</p>
          <span>{{ $labelsub3 }}</span>
        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-xl-4">
      <h6 class="text-muted">{{ __('Top performance') }}</h6>
      <div class="nav-align-top nav-tabs-shadow mb-6">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <button
              type="button"
              class="nav-link active"
              role="tab"
              style="font-size: 12px; padding-left: 2px; padding-right: 2px;"
              data-bs-toggle="tab"
              data-bs-target="#navs-top-home"
              aria-controls="navs-top-home"
              aria-selected="true">
              {{ __('Top earners') }}
            </button>
          </li>
          <li class="nav-item">
            <button
              type="button"
              class="nav-link"
              role="tab"
              style="font-size: 12px; padding-left: 2px; padding-right: 2px;"
              data-bs-toggle="tab"
              data-bs-target="#navs-top-profile"
              aria-controls="navs-top-profile"
              aria-selected="false">
              {{ __('Top recruiters')}}
            </button>
          </li>
          <li class="nav-item">
            <button
              type="button"
              class="nav-link"
              role="tab"
              style="font-size: 12px; padding-left: 2px; padding-right: 2px;"
              data-bs-toggle="tab"
              data-bs-target="#navs-top-messages"
              aria-controls="navs-top-messages"
              aria-selected="false">
              {{ __('Package overview') }}
            </button>
          </li>
        </ul>
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
            <div class="table-responsive text-nowrap">
              <table class="table">
                <tbody class="table-border-bottom-0">
                @foreach($topearners as $topearner)
                  <tr>
                    <td>
                      <span class="avatar avatar-xs pull-up d-inline-block">
                        <img src="{{ $topearner->image ? asset('storage/' . $topearner->image) : url('assets/img/avatars/5.png') }}" alt="Avatar" class="rounded-circle">
                      </span>
                      <span class="fw-medium">{{ $topearner->name }}</span>
                    </td>
                    <td>{{ $topearner->total_income }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
            <div class="table-responsive text-nowrap">
              <table class="table">
                <tbody class="table-border-bottom-0">
                @foreach($toprecruters as $toprecruter)
                  <tr>
                    <td>
                      <span class="avatar avatar-xs pull-up d-inline-block">
                        <img src="{{ $toprecruter->image ? asset('storage/' . $toprecruter->image) : url('assets/img/avatars/5.png') }}" alt="Avatar" class="rounded-circle">
                      </span>
                      <span class="fw-medium">{{ $toprecruter->name }}</span>
                    </td>
                    <td>{{ $toprecruter->subscribers_count }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
            <p>
              Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
              cupcake gummi bears cake chocolate.
            </p>
            <p class="mb-0">
              Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
              roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
              jelly-o tart brownie jelly.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8">
      <h6 class="text-muted">Vertical</h6>
      <div class="nav-align-left nav-tabs-shadow mb-6 row">

        <div class="tab-content col-md-6">
          @foreach($topearners as $earner)
          <div class="tab-pane text-center p-5 fade @if($loop->first) show active @endif" id="{{ $earner->name }}">
            <p>
              Total earned {{ $earner->name }}
            </p>
            <canvas id="doughnutChart{{ $earner->name }}" class="chartjs mb-6" data-height="350" height="150" width="150" style="display: block; box-sizing: border-box; height: 150px; width: 150px;"></canvas>
          </div>
          @endforeach

        </div>
        <ul class="nav nav-tabs col-md-6" role="tablist">
          <h4 class="p-4 mb-0">{{ __('Top earners') }}</h4>
          @foreach($topearners as $earner)
          <li class="nav-item">
            <button
              type="button"
              class="nav-link @if($loop->first) active @endif"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#{{ $earner->name }}"
              aria-controls="navs-left-home"
              aria-selected="true">
              {{ $earner->name }}
            </button>
          </li>
          @endforeach
        </ul>

      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-xl-4">
      <div class="card mb-6">
        <h5 class="card-header">{{ __('Recent activities') }}</h5>
        <div class="card-body pt-1 d-flex">
          <ul class="timeline mb-0">
              @foreach($activitis as $activity)
              <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary" style="background-color: unset !important; outline: none !important">
                <i class="fa fa-lock"></i>
              </span>
              <div class="timeline-event">
                <div class="timeline-header mb-3 d-block">
                  @php
                    $desc = str_replace('User '.$user->email.' (ID: '.$user->id.')','',$activity->description);
                  @endphp
                  <h6 class="mb-0">{{ ucwords($desc) }}</h6>
                  <small class="text-muted d-block">{{ $activity->created_at->format('D Y h:i A') }} ({{ $activity->created_at->diffForHumans() }})</small>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>

    </div>

    <div class="col-xl-8">
      <h6 class="text-muted">Vertical</h6>
      <div class="nav-align-left nav-tabs-shadow mb-6 row">
        <ul class="nav nav-tabs col-md-6" role="tablist">
          @foreach($recentsubscribers as $subscriber)
            <li class="nav-item">
            <button
              type="button"
              class="nav-link @if($loop->first) active @endif"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#sub-{{$subscriber->name}}"
              aria-controls="navs-left-home"
              aria-selected="true">
              {{ $subscriber->name }}
            </button>
          </li>
          @endforeach

        </ul>
        <div class="tab-content col-md-6">
          @foreach($recentsubscribers as $subscriber)
          <div class="tab-pane fade @if($loop->first) show active @endif" id="sub-{{$subscriber->name}}">

              <div class="card-body pt-12">
                <div class="user-avatar-section">
                  <div class="d-flex align-items-center flex-column">

                    <div class="user-info text-center">
                      <h5>{{ $subscriber->first_name }} {{ $subscriber->last_name }}</h5>
                      <span class="badge bg-label-secondary">{{ $subscriber->created_at->diffForHumans() }}</span>
                    </div>
                  </div>
                </div>

                <h5 class="pb-4 border-bottom mb-4">Details</h5>
                <div class="info-container">
                  <ul class="list-unstyled mb-6">
                    <li class="mb-2">
                      <span class="h6">{{ __('Member id') }}:</span>
                      <span>{{ $subscriber->unique_id }}</span>
                    </li>
                    <li class="mb-2">
                      <span class="h6">{{ __('User name') }}:</span>
                      <span>{{ $subscriber->name }}</span>
                    </li>
                    <li class="mb-2">
                      <span class="h6">{{ __('Package') }}:</span>
                      <span>{{ $subscriber->lifetimePackage?->name }}</span>
                    </li>
                    <li class="mb-2">
                      <span class="h6">{{ __('Sponsor') }}:</span>
                      <span>{{ $user->name }}</span>
                    </li>
                    <li class="mb-2">
                      <span class="h6">{{ __('Join date') }}:</span>
                      <span>{{ $subscriber->created_at->format('Y h d ') }}</span>
                    </li>

                  </ul>


              </div>
            </div>

          </div>
          @endforeach

        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
            <tr>
              <th>{{ __('Date') }}</th>
              <th>{{ __('Action') }}</th>
              <th>{{ __('Amount') }}</th>
              <th>{{ __('Status') }}</th>
              <th>{{ __('Details') }}</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($transactions as $transaction)
              <tr>
              <td>
                {{ $transaction->created_at->format('Y-m-d') }}
              </td>
              <td>{{ $transaction->action }}</td>
              <td>
                {{ $transaction->amount }}
              </td>
              <td><span class="badge bg-label-primary me-1">{{ $transaction->status }}</span></td>
              <td>
                <a class="btn btn-primary" href="{{ route('translation.show',$transaction->id) }}">View</a>
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>







<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to choose this plan?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Yes, proceed</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('vendor-script')
  @vite([
  'resources/assets/vendor/libs/clipboard/clipboard.js',
  'resources/assets/js/extended-ui-misc-clipboardjs.js',
  'resources/assets/vendor/libs/chartjs/chartjs.js',
  'resources/assets/js/main.js'
  ])

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      @foreach($topearners as $earner)
      const doughnutChart{{$earner->name}} = document.getElementById('doughnutChart{{$earner->name}}');
      if (doughnutChart{{$earner->name}}) {
        const doughnutChartVar{{$earner->name}} = new Chart(doughnutChart{{$earner->name}}, {
          type: 'doughnut',
          data: {
            labels: ['{{$earner->name}}'],
            datasets: [
              {
                data: [{{$earner->total_income}}],
                backgroundColor: ['#28dac6'],
                borderWidth: 0,
                pointStyle: 'rectRounded'
              }
            ]
          },
          options: {
            responsive: true,
            animation: {
              duration: 500
            },
            cutout: '68%',
            plugins: {
              legend: {
                display: false
              },
              tooltip: {
                callbacks: {
                  label: function (context) {
                    const label = context.labels || '',
                      value = context.parsed;
                    const output = ' Earned amount : ' + value;
                    return output;
                  }
                },
                // Updated default tooltip UI
                rtl: isRtl,
                backgroundColor: 'white',
                titleColor: 'black',
                bodyColor: 'blue',
                borderWidth: 1,
                borderColor: 'white'
              }
            }
          }
        });
      }
      @endforeach
    });
  </script>

  @if($user->lifetime_package == null && $remainingTime != 0)
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const modalElement = document.getElementById('modalCenter'); // Replace with your modal ID
      const myModal = new bootstrap.Modal(modalElement);
      myModal.show();
    });
  </script>
  @endif
<script>
    $(document).ready(function() {
            var formToSubmit;
            console.log('js ready');

            // When the "Choose Plan" button is clicked
            $('.btn-sub').on('click', function(event) {
                event.preventDefault();

                // Find the form based on the index and store it
                formToSubmit = $(this).closest('form');

                // Show the modal
                $('#confirmationModal').modal('show');
            });

            // When the user confirms
            $('#confirmButton').on('click', function() {
                if (formToSubmit) {
                    console.log('this form');
                    formToSubmit.submit(); // Submit the stored form
                }
            });
        });
</script>

@endsection
