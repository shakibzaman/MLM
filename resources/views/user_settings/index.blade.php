@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">User Settings</h4>
            <div>
                <a href="{{ route('user_settings.user_setting.create') }}" class="btn btn-secondary" title="Create New User Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($userSettings) == 0)
            <div class="card-body text-center">
                <h4>No User Settings Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Min Password Length</th>
                            <th>Max Password Length</th>
                            <th>Password For Withdraw</th>
                            <th>Confirm Code Account Update</th>
                            <th>Notify Status</th>
                            <th>Subscription Type</th>
                            <th>Password For Edit Profile</th>
                            <th>Email Change Status</th>
                            <th>Subscription Status</th>
                            <th>Subscription Grace Period</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($userSettings as $userSetting)
                        <tr>
                            <td class="align-middle">{{ $userSetting->min_password_length }}</td>
                            <td class="align-middle">{{ $userSetting->max_password_length }}</td>
                            <td class="align-middle">{{ implode('; ', $userSetting->password_for_withdraw) }}</td>
                            <td class="align-middle">{{ implode('; ', $userSetting->confirm_code_account_update) }}</td>
                            <td class="align-middle">{{ implode('; ', $userSetting->notify_status) }}</td>
                            <td class="align-middle">{{ $userSetting->subscription_type }}</td>
                            <td class="align-middle">{{ implode('; ', $userSetting->password_for_edit_profile) }}</td>
                            <td class="align-middle">{{ implode('; ', $userSetting->email_change_status) }}</td>
                            <td class="align-middle">{{ implode('; ', $userSetting->subscription_status) }}</td>
                            <td class="align-middle">{{ $userSetting->subscription_grace_period }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('user_settings.user_setting.destroy', $userSetting->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('user_settings.user_setting.show', $userSetting->id ) }}" class="btn btn-info" title="Show User Setting">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('user_settings.user_setting.edit', $userSetting->id ) }}" class="btn btn-primary" title="Edit User Setting">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete User Setting" onclick="return confirm(&quot;Click Ok to delete User Setting.&quot;)">
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

            {!! $userSettings->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection