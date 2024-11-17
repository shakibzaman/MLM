@extends('layouts/layoutMaster')

@section('title', 'Create KYC')

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {!! session('success_message') !!}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">Site Settings</h4>
        <div>
            <a href="{{ route('site_settings-global_settings-create') }}" class="btn btn-secondary" title="Create New Global Setting">
                <span class="fa-solid fa-plus" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($globalSettings) == 0)
    <div class="card-body text-center">
        <h4>No Global Settings Available.</h4>
    </div>
    @else
    <div class="card-body p-0">
        <div class="table-responsive">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Site Logo</th>
                        <th>Site Fevicon</th>
                        <th>Admin Login Cover</th>
                        <th>Site Admin Prefix</th>
                        <th>Site Currency Type</th>
                        <th>Site Currency</th>
                        <th>Timezon</th>
                        <th>Referral type</th>
                        <th>Currency Symbol</th>
                        <th>Referral Code Limit</th>
                        <th>Home Redirect</th>
                        <th>Site Title</th>
                        <th>Site Email</th>
                        <th>Support Email</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($globalSettings as $globalSetting)
                    <tr>
                        <td class="align-middle">{{ $globalSetting->site_logo }}</td>
                        <td class="align-middle">{{ $globalSetting->site_fevicon }}</td>
                        <td class="align-middle">{{ $globalSetting->admin_login_cover }}</td>
                        <td class="align-middle">{{ $globalSetting->site_admin_prefix }}</td>
                        <td class="align-middle">{{ $globalSetting->site_currency_type }}</td>
                        <td class="align-middle">{{ $globalSetting->site_currency }}</td>
                        <td class="align-middle">{{ $globalSetting->timezon }}</td>
                        <td class="align-middle">{{ $globalSetting->referral_type }}</td>
                        <td class="align-middle">{{ $globalSetting->currency_symbol }}</td>
                        <td class="align-middle">{{ $globalSetting->referral_code_Limit }}</td>
                        <td class="align-middle">{{ $globalSetting->home_redirect }}</td>
                        <td class="align-middle">{{ $globalSetting->site_title }}</td>
                        <td class="align-middle">{{ $globalSetting->site_email }}</td>
                        <td class="align-middle">{{ $globalSetting->support_email }}</td>

                        <td class="text-end">

                            <form method="POST" action="{!! route('site_settings-global_settings-destroy', $globalSetting->id) !!}"
                                accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('site_settings-global_settings-show', $globalSetting->id ) }}"
                                        class="btn btn-info" title="Show Global Setting">
                                        <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('site_settings-global_settings-edit', $globalSetting->id ) }}"
                                        class="btn btn-primary" title="Edit Global Setting">
                                        <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="Delete Global Setting"
                                        onclick="return confirm(&quot;Click Ok to delete Global Setting.&quot;)">
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

        {!! $globalSettings->links('pagination') !!}
    </div>

    @endif

</div>
@endsection