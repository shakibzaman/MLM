@extends('layouts/layoutMaster')

@section('title', 'Site Settings')

<!-- Vendor Styles -->

@section('vendor-style')
@vite([
'resources/assets/vendor/libs/select2/select2.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
'resources/assets/vendor/libs/animate-css/animate.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
'resources/assets/vendor/libs/quill/typography.scss',
'resources/assets/vendor/libs/quill/katex.scss',
'resources/assets/vendor/libs/quill/editor.scss',
'resources/assets/vendor/libs/dropzone/dropzone.scss',
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/tagify/tagify.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js',
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
'resources/assets/vendor/libs/quill/katex.js',
'resources/assets/vendor/libs/quill/quill.js',
'resources/assets/vendor/libs/dropzone/dropzone.js',
'resources/assets/vendor/libs/jquery-repeater/jquery-repeater.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/tagify/tagify.js'
])

<script>
    function previewImage(inputElement, previewElementId) {
        const file = inputElement.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewElementId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Event listener for site logo
    document.getElementById('site_logo_preview').addEventListener('click', function() {
        document.getElementById('site_logo_input').click();
    });
    document.getElementById('site_logo_input').addEventListener('change', function() {
        previewImage(this, 'site_logo_preview');
    });

    // Event listener for site fevicon
    document.getElementById('site_fevicon_preview').addEventListener('click', function() {
        document.getElementById('site_fevicon_input').click();
    });
    document.getElementById('site_fevicon_input').addEventListener('change', function() {
        previewImage(this, 'site_fevicon_preview');
    });

    // Event listener for admin login cover
    document.getElementById('admin_login_cover_preview').addEventListener('click', function() {
        document.getElementById('admin_login_cover_input').click();
    });
    document.getElementById('admin_login_cover_input').addEventListener('change', function() {
        previewImage(this, 'admin_login_cover_preview');
    });
</script>
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection
@section('content')

<div class="text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h2 class="m-0 text-bold">{{ !empty($title) ? $title : 'Site Setting' }}</h2>
    </div>
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <a class="btn-info btn" href="{{ route('site_settings-global_settings-index') }}"><i
                            class="fa fa-cogs"></i> Site
                        Settings</a>
                </div>

                <div class="col-md-2">
                    <a class="btn" href="{{ route('mail_settings.mail_setting.index') }}"><i
                            class="fas fa-envelope-open"></i> Email Settings</a>
                </div>
                <div class="col-md-2">
                    <a class="btn" href="{{ route('plugin_settings.plugin_setting.index') }}"><i
                            class="fas fa-briefcase"></i> Plugin Settings</a>

                </div>
                <div class="col-md-2">
                    <a class=" btn"><i class="fas fa-comment"></i> SMS Settings</a>

                </div>
                <div class="col-md-2">
                    <a class=" btn" href="{{ route('notification_settings') }}"><i class="fas fa-bell"></i> Notification
                        Settings</a>

                </div>

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
        <div class="row">
            <div class="col-md-6">
                <div class="card p-2">
                    <div class="card-header">
                        <h5 class="text-bold">Global Settings</h5>
                    </div>
                    <form method="POST" class="needs-validation" novalidate
                        action="{{ route('site_settings-global_settings-update', 1) }}" id="edit_global_setting_form"
                        name="edit_global_setting_form" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        @include ('global_settings.form', [
                        'globalSetting' => $globalSetting,
                        'currencies'=>$currencies,
                        'site_currency_types'=>$site_currency_types,
                        'referral_types',
                        'timezones',
                        'home_redirects'

                        ])

                        <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                            <input class="btn-primary p-2" type="submit" value="Save Change">
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card p-2">
                    <div class="card-header">
                        <h5 class="text-bold">Permission Settings</h5>
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
                            action="{{ route('permission_settings.permission_setting.update', $permissionSetting->id) }}"
                            id="edit_permission_setting_form" name="edit_permission_setting_form"
                            accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            @include ('permission_settings.form', [
                            'permissionSetting' => $permissionSetting,
                            ])

                            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                                <input class="btn-primary p-2" type="submit" value="Update">
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>


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

@section('page-script')
<script>
    function previewImage(inputElement, previewElementId) {
        const file = inputElement.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewElementId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Event listener for site logo
    document.getElementById('site_logo_preview').addEventListener('click', function() {
        document.getElementById('site_logo_input').click();
    });
    document.getElementById('site_logo_input').addEventListener('change', function() {
        previewImage(this, 'site_logo_preview');
    });

    // Event listener for site fevicon
    document.getElementById('site_fevicon_preview').addEventListener('click', function() {
        document.getElementById('site_fevicon_input').click();
    });
    document.getElementById('site_fevicon_input').addEventListener('change', function() {
        previewImage(this, 'site_fevicon_preview');
    });

    // Event listener for admin login cover
    document.getElementById('admin_login_cover_preview').addEventListener('click', function() {
        document.getElementById('admin_login_cover_input').click();
    });
    document.getElementById('admin_login_cover_input').addEventListener('change', function() {
        previewImage(this, 'admin_login_cover_preview');
    });
</script>
@stop