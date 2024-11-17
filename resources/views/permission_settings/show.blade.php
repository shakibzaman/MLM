@extends('layouts/layoutMaster')

@section('title', 'Site Settings')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Permission Setting' }}</h4>
        <div>
            <form method="POST"
                action="{!! route('permission_settings.permission_setting.destroy', $permissionSetting->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('permission_settings.permission_setting.edit', $permissionSetting->id ) }}"
                    class="btn btn-primary" title="Edit Permission Setting">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Permission Setting"
                    onclick="return confirm(&quot;Click Ok to delete Permission Setting.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('permission_settings.permission_setting.index') }}" class="btn btn-primary"
                    title="Show All Permission Setting">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('permission_settings.permission_setting.create') }}" class="btn btn-secondary"
                    title="Create New Permission Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Email Verification</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->email_verification) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Kyc Verification</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->kyc_verification) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">2Fa-Verification</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->two_fa_verification) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Account Creation</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->account_creation) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">User Deposit</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->user_deposit) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">User Withdraw</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->user_withdraw) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">User Send Money</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->user_send_money) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">User Referral</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->user_referral) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Signup Bonus</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->signup_bonus) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Investment Referral Bounty</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->investment_referral_bounty) ? 'Disabled' : 'Enabled'
                }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Deposit Referral Bounty</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->deposit_referral_bounty) ? 'Disabled' : 'Enabled' }}
            </dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Animation</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->site_animation) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Back to Top</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->site_back_to_top) ? 'Disabled' : 'Enabled' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Development Mode</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($permissionSetting->development_mode) ? 'Disabled' : 'Enabled' }}</dd>

        </dl>

    </div>
</div>

@endsection