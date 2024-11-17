@extends('layouts/layoutMaster')

@section('title', 'Site Settings')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Permission Settings</h4>
            <div>
                <a href="{{ route('permission_settings.permission_setting.create') }}" class="btn btn-secondary" title="Create New Permission Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($permissionSettings) == 0)
            <div class="card-body text-center">
                <h4>No Permission Settings Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Email Verification</th>
                            <th>Kyc Verification</th>
                            <th>2Fa Verification</th>
                            <th>Account Creation</th>
                            <th>User Deposit</th>
                            <th>User Withdraw</th>
                            <th>User Send Money</th>
                            <th>User Referral</th>
                            <th>Signup Bonus</th>
                            <th>Investment Referral Bounty</th>
                            <th>Deposit Referral Bounty</th>
                            <th>Site Animation</th>
                            <th>Site Back to Top</th>
                            <th>Development Mode</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($permissionSettings as $permissionSetting)
                        <tr>
                            <td class="align-middle">{{ ($permissionSetting->email_verification) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->kyc_verification) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->two_fa_verification) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->account_creation) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->user_deposit) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->user_withdraw) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->user_send_money) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->user_referral) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->signup_bonus) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->investment_referral_bounty) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->deposit_referral_bounty) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->site_animation) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->site_back_to_top) ? 'Disabled' : 'Enabled' }}</td>
                            <td class="align-middle">{{ ($permissionSetting->development_mode) ? 'Disabled' : 'Enabled' }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('permission_settings.permission_setting.destroy', $permissionSetting->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('permission_settings.permission_setting.show', $permissionSetting->id ) }}" class="btn btn-info" title="Show Permission Setting">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('permission_settings.permission_setting.edit', $permissionSetting->id ) }}" class="btn btn-primary" title="Edit Permission Setting">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Permission Setting" onclick="return confirm(&quot;Click Ok to delete Permission Setting.&quot;)">
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

            {!! $permissionSettings->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection