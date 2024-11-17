@extends('layouts/layoutMaster')

@section('title', 'Rank rewards')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">{{ !empty($rankReward->name) ? $rankReward->name : 'Rank Reward' }}</h4>
            <div>
                <a href="{{ route('rank_rewards.rank_reward.index') }}" class="btn btn-primary" title="Show All Rank Reward">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('rank_rewards.rank_reward.create') }}" class="btn btn-secondary" title="Create New Rank Reward">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" class="needs-validation" novalidate action="{{ route('rank_rewards.rank_reward.update', $rankReward->id) }}" id="edit_rank_reward_form" name="edit_rank_reward_form" accept-charset="UTF-8"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('rank_rewards.form', [
                                        'rankReward' => $rankReward,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                  <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>

        </div>
    </div>

@endsection
