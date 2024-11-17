@extends('layouts/layoutMaster')

@section('title', 'Site Settings')

@section('content')

<div class="text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h2 class="m-0 text-bold">{{ !empty($title) ? $title : 'Site Setting' }}</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <a class=" btn" href="{{ route('site_settings-global_settings-index') }}"><i class="fa fa-cogs"></i>
                    Site
                    Settings</a>

                <a class="btn-info btn"><i class="fas fa-envelope-open"></i> Email Settings</a>

                <a class="btn"><i class="fas fa-briefcase"></i> Plugin Settings</a>

                <a class=" btn"><i class="fas fa-comment"></i> SMS Settings</a>


                <a class=" btn"><i class="fas fa-bell"></i> Notification Settings</a>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-bold">Mail Settings</h5>
                        </div>
                        <div class="col-md-6 ">
                            <button class="btn btn-info float-right"><i class="fas fa-envelope-open"></i> Connection
                                Check</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="list-unstyled mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" class="needs-validation" novalidate
                        action="{{ route('mail_settings.mail_setting.store') }}" accept-charset="UTF-8"
                        id="create_mail_setting_form" name="create_mail_setting_form">
                        {{ csrf_field() }}
                        @include ('mail_settings.form', [
                        'mailSetting' => null,
                        ])

                        <div class="col-lg-8 col-xl-8 offset-lg-4 offset-xl-4">
                            <input class="btn btn-info" type="submit" value="Add" style="width:100%">
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection