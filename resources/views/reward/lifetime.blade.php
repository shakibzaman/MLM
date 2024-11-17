@extends('layouts/layoutMaster')

@section('title', 'Lifetime reward')

@section('content')
  <div class="nav-align-top">
    <ul class="nav nav-pills flex-column flex-md-row mb-6 row-gap-2">
      <li class="nav-item">
        <a class="nav-link active waves-effect waves-light" href="@if(auth()->guard('customer')->user()) {{ route('customer.reward.lifetime') }} @else {{ route('reward.lifetime') }} @endif"><i class="ti ti-map-pin ti-sm me-1_5"></i>Lifetime</a>
      </li>
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light" href="@if(auth()->guard('customer')->user()) {{ route('customer.reward.monthly') }} @else {{ route('reward.monthly') }} @endif"><i class="ti ti-bell ti-sm me-1_5"></i>Monthly</a>
      </li>
    </ul>
  </div>
  <div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
      <h4 class="m-0">Lifetime reward</h4>
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
              <th>Total income</th>
              <th>Rank</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
              <tr>
                <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->index + 1 }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->total_income }}</td>
                <td>{{ $customer->ranking->name ?? "N/A" }}</td>
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
