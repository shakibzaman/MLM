@extends('layouts/layoutMaster')

@section('title', 'Monthly reward')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">{{ !empty($title) ? $title : 'Monthly Reward' }}</h4>
            <div>
                <a href="{{ route('monthly_rewards.monthly_reward.index') }}" class="btn btn-primary" title="Show All Monthly Reward">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('monthly_rewards.monthly_reward.create') }}" class="btn btn-secondary" title="Create New Monthly Reward">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        <div class="card-body">



            <form method="POST" class="needs-validation" novalidate action="{{ route('monthly_rewards.monthly_reward.update', $monthlyReward->id) }}" id="edit_monthly_reward_form" name="edit_monthly_reward_form" accept-charset="UTF-8" >
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('monthly_rewards.form', [
                                        'monthlyReward' => $monthlyReward,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                  <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>

        </div>
    </div>

@endsection
