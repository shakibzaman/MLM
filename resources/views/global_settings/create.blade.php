@extends('layouts/layoutMaster')

@section('title', 'Create KYC')

@section('content')

<div class="text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h2 class="m-0 text-bold">{{ !empty($title) ? $title : 'Site Setting' }}</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <a class="btn-info btn" href="{{ route('site_settings-global_settings-index') }}"><i
                        class="fa fa-cogs"></i> Site
                    Settings</a>

                <a class=" btn"><i class="fas fa-envelope-open"></i> Email Settings</a>

                <a class="btn"><i class="fas fa-briefcase"></i> Plugin Settings</a>

                <a class=" btn"><i class="fas fa-comment"></i> SMS Settings</a>


                <a class=" btn"><i class="fas fa-bell"></i> Notification Settings</a>

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

        <form method="POST" class="needs-validation" novalidate action="{{ route('site_settings-global_settings-store') }}"
            accept-charset="UTF-8" id="create_global_setting_form" name="create_global_setting_form"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            @include ('global_settings.create-form', [
            'globalSetting' => null,
            ])

            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                <input class="btn btn-primary" type="submit" value="Add">
            </div>

        </form>

    </div>
</div>

@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px);
    }

    .position-relative {
        position: relative;
        display: inline-block;
    }

    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 16px;
        font-weight: bold;
        text-shadow: 1px 1px 2px black;
        pointer-events: none;
        /* Prevents text from blocking clicks */
    }

    #logo_image {
        cursor: pointer;
    }
</style>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#site_currency').select2({
            placeholder: "Select site currency",
            allowClear: true
        });

        $('#site_currency_type').select2({
            placeholder: "Select site currency type",
            allowClear: true
        });

        $('#timezon').select2({
            placeholder: "Select timezone",
            allowClear: true
        });

        $('#referral_type').select2({
            placeholder: "Select referral type",
            allowClear: true
        });

        $('#home_redirect').select2({
            placeholder: "Select home redirect",
            allowClear: true
        });
    });
</script>
<script>
    document.getElementById('logo_image').addEventListener('click', function() {
        document.getElementById('site_logo').click();
    });
</script>
@stop