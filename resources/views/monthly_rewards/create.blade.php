@extends('layouts/layoutMaster')

@section('title', 'Monthly reward')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Create New Monthly Reward</h4>
            <div>
                <a href="{{ route('monthly_rewards.monthly_reward.index') }}" class="btn btn-primary" title="Show All Monthly Reward">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>
            </div>
        </div>


        <div class="card-body">

            <form method="POST" class="needs-validation" novalidate action="{{ route('monthly_rewards.monthly_reward.store') }}" accept-charset="UTF-8" id="create_monthly_reward_form" name="create_monthly_reward_form" >
            {{ csrf_field() }}
            @include ('monthly_rewards.form', [
                                        'monthlyReward' => null,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>

            </form>

        </div>
    </div>

@endsection


