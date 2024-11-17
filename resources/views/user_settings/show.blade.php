@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'User Setting' }}</h4>
        <div>
            <form method="POST" action="{!! route('user_settings.user_setting.destroy', $userSetting->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('user_settings.user_setting.edit', $userSetting->id ) }}" class="btn btn-primary"
                    title="Edit User Setting">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete User Setting"
                    onclick="return confirm(&quot;Click Ok to delete User Setting.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('user_settings.user_setting.index') }}" class="btn btn-primary"
                    title="Show All User Setting">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('user_settings.user_setting.create') }}" class="btn btn-secondary"
                    title="Create New User Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Min Password Length</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->min_password_length }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Max Password Length</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->max_password_length }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Password For Withdraw</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->password_for_withdraw}}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Confirm Code Account Update</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->confirm_code_account_update}}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Notify Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->notify_status}}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Subscription Type</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->subscription_type }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Password For Edit Profile</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->password_for_edit_profile}}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Email Change Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->email_change_status}}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Subscription Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->subscription_status}}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Subscription Grace Period</dt>
            <dd class="col-lg-10 col-xl-9">{{ $userSetting->subscription_grace_period }}</dd>

        </dl>

    </div>
</div>

@endsection