@extends('layouts/layoutMaster')

@section('title', 'Plugin Settings')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($pluginSetting->name) ? $pluginSetting->name : 'Plugin Setting' }}</h4>
        <div>
            <form method="POST" action="{!! route('plugin_settings.plugin_setting.destroy', $pluginSetting->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('plugin_settings.plugin_setting.edit', $pluginSetting->id ) }}"
                    class="btn btn-primary" title="Edit Plugin Setting">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Plugin Setting"
                    onclick="return confirm(&quot;Click Ok to delete Plugin Setting.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('plugin_settings.plugin_setting.index') }}" class="btn btn-primary"
                    title="Show All Plugin Setting">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('plugin_settings.plugin_setting.create') }}" class="btn btn-secondary"
                    title="Create New Plugin Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $pluginSetting->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $pluginSetting->status }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Tawk Property</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($pluginSetting->tawkProperty)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Tawk Widget</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($pluginSetting->tawkWidget)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Google Recaptcha Key</dt>
            <dd class="col-lg-10 col-xl-9">{{ $pluginSetting->google_recaptcha_key }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Google Recaptcha Secret</dt>
            <dd class="col-lg-10 col-xl-9">{{ $pluginSetting->google_recaptcha_secret }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Google Analytics</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($pluginSetting->googleAnalytic)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Fb Page</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($pluginSetting->fbPage)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Pusher App</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($pluginSetting->pusherApp)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Pusher App Key</dt>
            <dd class="col-lg-10 col-xl-9">{{ $pluginSetting->pusher_app_key }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Pusher Secret</dt>
            <dd class="col-lg-10 col-xl-9">{{ $pluginSetting->pusher_secret }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Pusher Cluster</dt>
            <dd class="col-lg-10 col-xl-9">{{ $pluginSetting->pusher_cluster }}</dd>

        </dl>

    </div>
</div>

@endsection