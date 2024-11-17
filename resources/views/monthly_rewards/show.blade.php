@extends('layouts/layoutMaster')

@section('title', 'Monthly reward')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Monthly Reward' }}</h4>
        <div>
            <form method="POST" action="{!! route('monthly_rewards.monthly_reward.destroy', $monthlyReward->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
              @if(!$monthlyReward->disburse_status)
                <a href="{{ route('monthly_rewards.monthly_reward.edit', $monthlyReward->id ) }}" class="btn btn-primary" title="Edit Monthly Reward">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Monthly Reward" onclick="return confirm(&quot;Click Ok to delete Monthly Reward.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>
              @endif
                <a href="{{ route('monthly_rewards.monthly_reward.index') }}" class="btn btn-primary" title="Show All Monthly Reward">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('monthly_rewards.monthly_reward.create') }}" class="btn btn-secondary" title="Create New Monthly Reward">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Year</dt>
            <dd class="col-lg-10 col-xl-9">{{ $monthlyReward->year }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Month</dt>
            <dd class="col-lg-10 col-xl-9">{{ $monthlyReward->month }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Reward Amount</dt>
            <dd class="col-lg-10 col-xl-9">{{ $monthlyReward->reward_amount }}</dd>
          <dt class="text-lg-end col-lg-2 col-xl-3">Disburse status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $monthlyReward->disburse_status ? 'Yes' : 'NO' }}</dd>

        </dl>
      @if(!$monthlyReward->disburse_status)
      <form method="POST" action="{!! route('monthly_rewards.monthly_reward.disburse') !!}" accept-charset="UTF-8">
        <input name="reward_id" value="{{$monthlyReward->id}}" type="hidden">
        {{ csrf_field() }}

          <button type="submit" class="btn btn-success" title="Disburse Monthly Reward" onclick="return confirm(&quot;Click Ok to Disburse Monthly Reward.?&quot;)">
            Disburse
          </button>

      </form>
      @endif

    </div>
</div>
<div class="card mt-5">
  <div class="card-header">
    <h3>Leaderboard</h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">

      <table class="table table-striped ">
        <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
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
            <td>{{ $customer->incomes_sum_amount }}</td>
            <td>{{ number_format($customer->calculateMonthlyReward($customer->incomes_sum_amount),2) }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>

    </div>

    {!! $customers->links('pagination') !!}
  </div>
</div>
@endsection
