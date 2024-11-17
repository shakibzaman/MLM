@extends('layouts/layoutMaster')

@section('title', 'Monthly reward')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Monthly Rewards</h4>
            <div>
                <a href="{{ route('monthly_rewards.monthly_reward.create') }}" class="btn btn-secondary" title="Create New Monthly Reward">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        @if(count($monthlyRewards) == 0)
            <div class="card-body text-center">
                <h4>No Monthly Rewards Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Reward Amount</th>
                            <th>Disburse status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($monthlyRewards as $monthlyReward)
                        <tr>
                            <td class="align-middle">{{ $monthlyReward->year }}</td>
                            <td class="align-middle">{{ date('F', mktime(0, 0, 0, $monthlyReward->month,1)) }}</td>
                            <td class="align-middle">{{ $monthlyReward->reward_amount }}</td>
                            <td class="align-middle">{{ $monthlyReward->disburse_status ? 'Yes' : 'NO' }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('monthly_rewards.monthly_reward.destroy', $monthlyReward->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('monthly_rewards.monthly_reward.show', $monthlyReward->id ) }}" class="btn btn-info" title="Show Monthly Reward">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                      @if(!$monthlyReward->disburse_status)
                                        <a href="{{ route('monthly_rewards.monthly_reward.edit', $monthlyReward->id ) }}" class="btn btn-primary" title="Edit Monthly Reward">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Monthly Reward" onclick="return confirm(&quot;Click Ok to delete Monthly Reward.&quot;)">
                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                        </button>
                                      @endif
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $monthlyRewards->links('pagination') !!}
        </div>

        @endif

    </div>
@endsection
