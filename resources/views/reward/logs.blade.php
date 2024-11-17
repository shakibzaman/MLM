@extends('layouts/layoutMaster')

@section('title', 'Lifetime reward')

@section('content')
  <div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
      <h4 class="m-0">Reward log</h4>
    </div>

    @if(count($logs) == 0)
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
              <th>Reward type</th>
              <th>Reward</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
              <tr>
                <td>{{ ($logs->currentPage() - 1) * $logs->perPage() + $loop->index + 1 }}</td>
                <td>{{ $log->customer?->name }}</td>
                <td>{{ $log->customer?->email }}</td>
                <td>{{ $log->reward_type }}</td>
                <td>{{ $log->amount }}</td>
                <td>{{ $log->created_at->format('Y-M-d') }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>

        </div>

        {!! $logs->links('pagination') !!}
      </div>

    @endif

  </div>
@endsection
