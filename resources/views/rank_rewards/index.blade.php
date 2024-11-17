@extends('layouts/layoutMaster')

@section('title', 'Rank rewards')

@section('content')


    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Rank Rewards</h4>
            <div>
                <a href="{{ route('rank_rewards.rank_reward.create') }}" class="btn btn-secondary" title="Create New Rank Reward">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        @if(count($rankRewards) == 0)
            <div class="card-body text-center">
                <h4>No Rank Rewards Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Bonus</th>
                            <th>Minimum Referrals</th>
                            <th>Direct Referrals</th>
                            <th>Active Subscribers</th>
                            <th>Earnings</th>
                            <th>Days</th>


                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($rankRewards as $rankReward)
                        <tr>
                            <td class="align-middle">{{ $rankReward->name }}</td>
                            <td class="align-middle">{{ $rankReward->bonus }}</td>
                            <td class="align-middle">{{ $rankReward->minimum_referrals }}</td>
                            <td class="align-middle">{{ $rankReward->direct_referrals }}</td>
                            <td class="align-middle">{{ $rankReward->active_subscribers }}</td>
                            <td class="align-middle">{{ $rankReward->earnings }}</td>
                            <td class="align-middle">{{ $rankReward->days }}</td>
                            <td class="text-end">

                                <form method="POST" action="{!! route('rank_rewards.rank_reward.destroy', $rankReward->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('rank_rewards.rank_reward.show', $rankReward->id ) }}" class="btn btn-info" title="Show Rank Reward">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('rank_rewards.rank_reward.edit', $rankReward->id ) }}" class="btn btn-primary" title="Edit Rank Reward">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Rank Reward" onclick="return confirm(&quot;Click Ok to delete Rank Reward.&quot;)">
                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $rankRewards->links('pagination') !!}
        </div>

        @endif

    </div>
@endsection
