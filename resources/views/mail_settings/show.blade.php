@extends('layouts/layoutMaster')

@section('title', 'Site Settings')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Mail Setting' }}</h4>
        <div>
            <form method="POST" action="{!! route('mail_settings.mail_setting.destroy', $mailSetting->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('mail_settings.mail_setting.edit', $mailSetting->id ) }}" class="btn btn-primary"
                    title="Edit Mail Setting">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Mail Setting"
                    onclick="return confirm(&quot;Click Ok to delete Mail Setting.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('mail_settings.mail_setting.index') }}" class="btn btn-primary"
                    title="Show All Mail Setting">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('mail_settings.mail_setting.create') }}" class="btn btn-secondary"
                    title="Create New Mail Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Email From Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $mailSetting->email_from_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Email From Address</dt>
            <dd class="col-lg-10 col-xl-9">{{ $mailSetting->email_from_address }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Mailing Driver</dt>
            <dd class="col-lg-10 col-xl-9">{{ $mailSetting->mailing_driver }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Mail User Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $mailSetting->mail_user_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Mail Password</dt>
            <dd class="col-lg-10 col-xl-9">{{ $mailSetting->mail_password }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Smpt Host</dt>
            <dd class="col-lg-10 col-xl-9">{{ $mailSetting->smpt_host }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Smpt Port</dt>
            <dd class="col-lg-10 col-xl-9">{{ $mailSetting->smpt_port }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Smtp Secure</dt>
            <dd class="col-lg-10 col-xl-9">{{ $mailSetting->smtp_secure }}</dd>

        </dl>

    </div>
</div>

@endsection