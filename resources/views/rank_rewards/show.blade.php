@extends('layouts/layoutMaster')

@section('title', 'Rank rewards')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($rankReward->name) ? $rankReward->name : 'Rank Reward' }}</h4>
        <div>
            <form method="POST" action="{!! route('rank_rewards.rank_reward.destroy', $rankReward->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('rank_rewards.rank_reward.edit', $rankReward->id ) }}" class="btn btn-primary" title="Edit Rank Reward">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Rank Reward" onclick="return confirm(&quot;Click Ok to delete Rank Reward.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('rank_rewards.rank_reward.index') }}" class="btn btn-primary" title="Show All Rank Reward">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('rank_rewards.rank_reward.create') }}" class="btn btn-secondary" title="Create New Rank Reward">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rankReward->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Bonus</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rankReward->bonus }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Minimum Referrals</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rankReward->minimum_referrals }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Direct Referrals</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rankReward->direct_referrals }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Active Subscribers</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rankReward->active_subscribers }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Earnings</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rankReward->earnings }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Days</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rankReward->days }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Badge</dt>
            <dd class="col-lg-10 col-xl-9">@if($rankReward->badge)<a href="{{ asset('storage/' . $rankReward->badge) }}" target="_blank">Show</a>@endif</dd>

        </dl>

    </div>
</div>

@endsection
