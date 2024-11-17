@extends('layouts/layoutMaster')

@section('title', 'Monthly reward')

@section('content')
  <div class="nav-align-top">
    <ul class="nav nav-pills flex-column flex-md-row mb-6 row-gap-2">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light" href="@if(auth()->guard('customer')->user()) {{ route('customer.reward.lifetime') }} @else {{ route('reward.lifetime') }} @endif"><i class="ti ti-map-pin ti-sm me-1_5"></i>Lifetime</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active waves-effect waves-light" href="@if(auth()->guard('customer')->user()) {{ route('customer.reward.monthly') }} @else {{ route('reward.monthly') }} @endif"><i class="ti ti-bell ti-sm me-1_5"></i>Monthly</a>
      </li>
    </ul>
  </div>
  <div class="card mb-5">
    <div class="card-body">
      <p>Reward amount: {{ $rewardAmount }}</p>
    </div>
  </div>
  <div class="leaderboard">
    <div class="row">
      <div class="col-md-4">
      <div class="card m-8 p-3 text-center">
        <img
          class="img-fluid rounded-circle border m-auto m-4"
          src="{{ $topcustomers[1]->image ? asset('storage/'.$topcustomers[1]->image) : asset('path/to/placeholder.jpg') }}"
          alt="User 1"
          style="width: 150px; height: 150px; object-fit: cover;"
        />
        <h2>2nd Place</h2>
        <p>{{ $topcustomers[1]->name }}</p>
        <span>Income: {{ $topcustomers[1]->incomes_sum_amount }}</span>
        <span>Referral: {{ $topcustomers[1]->active_subscribers_count }}</span>
        <span>Reward: {{ number_format($topcustomers[1]->calculateMonthlyReward($topcustomers[1]->incomes_sum_amount),2) }}</span>
      </div>
      </div>
      <div class="col-md-4">
      <div class="card m-8 mt-0 p-3 text-center">
        <img
          class="img-fluid rounded-circle border m-auto m-4"
          src="{{ $topcustomers[0]->image ? asset('storage/'.$topcustomers[0]->image) : asset('path/to/placeholder.jpg') }}"
          alt="User 1"
          style="width: 150px; height: 150px; object-fit: cover;"
        />
        <h2>1st Place</h2>
        <p>{{ $topcustomers[0]->name }}</p>
        <span>Income: {{ $topcustomers[0]->incomes_sum_amount }}</span>
        <span>Referral: {{ $topcustomers[0]->active_subscribers_count }}</span>
        <span>Reward: {{ number_format($topcustomers[0]->calculateMonthlyReward($topcustomers[0]->incomes_sum_amount),2) }}</span>
      </div>
      </div>
      <div class="col-md-4">
      <div class="card m-8 p-3 text-center">
        <img
          class="img-fluid rounded-circle border m-auto m-4"
          src="{{ $topcustomers[2]->image ? asset('storage/'.$topcustomers[2]->image) : asset('path/to/placeholder.jpg') }}"
          alt="User 1"
          style="width: 150px; height: 150px; object-fit: cover;"
        />
      <h2>3rd Place</h2>
      <p>{{ $topcustomers[2]->name }}</p>
        <span>Income: {{ $topcustomers[2]->incomes_sum_amount }}</span>
        <span>Referral: {{ $topcustomers[2]->active_subscribers_count }}</span>
        <span>Reward: {{ number_format($topcustomers[2]->calculateMonthlyReward($topcustomers[2]->incomes_sum_amount),2) }}</span>
    </div>
      </div>
    </div>
  </div>
  </div>
  <div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
      <h4 class="m-0">Monthly reward</h4>
    </div>

    @if(count($customers) == 0)
      <div class="card-body text-center">
        <h4>No reward Available.</h4>
      </div>
    @else
      <div class="card-body p-0">
        <div class="table-responsive">

          <table class="table table-striped ">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Active referral</th>
              <th>Income</th>
              <th>Reward</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
              <tr>
                <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->index + 1 }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->active_subscribers_count }}</td>
                <td>{{ $customer->incomes_sum_amount }}</td>
                <td>{{ number_format($customer->calculateMonthlyReward($customer->incomes_sum_amount),2) }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>

        </div>

        {!! $customers->links('pagination') !!}
      </div>

    @endif

  </div>
@endsection
