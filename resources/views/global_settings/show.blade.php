@extends('layouts/layoutMaster')

@section('title', 'Create KYC')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Global Setting' }}</h4>
        <div>
            <form method="POST" action="{!! route('global_settings-destroy', $globalSetting->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('site_settings-global_settings-edit', $globalSetting->id ) }}" class="btn btn-primary"
                    title="Edit Global Setting">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Global Setting"
                    onclick="return confirm(&quot;Click Ok to delete Global Setting.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('site_settings-global_settings-index') }}" class="btn btn-primary" title="Show All Global Setting">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('site_settings-global_settings-create') }}" class="btn btn-secondary"
                    title="Create New Global Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Logo</dt>
            <dd class="col-lg-10 col-xl-9">{{ asset('storage/' . $globalSetting->site_logo) }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Fevicon</dt>
            <dd class="col-lg-10 col-xl-9">{{ asset('storage/' . $globalSetting->site_fevicon) }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Admin Login Cover</dt>
            <dd class="col-lg-10 col-xl-9">{{ asset('storage/' . $globalSetting->admin_login_cover) }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Admin Prefix</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->site_admin_prefix }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Currency Type</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->site_currency_type }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Currency</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->site_currency }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Timezon</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->timezon }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Referral type</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->referral_type }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Currency Symbol</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->currency_symbol }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Referral Code Limit</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->referral_code_Limit }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Home Redirect</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->home_redirect }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Title</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->site_title }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Site Email</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->site_email }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Support Email</dt>
            <dd class="col-lg-10 col-xl-9">{{ $globalSetting->support_email }}</dd>

        </dl>

    </div>
</div>

@endsection