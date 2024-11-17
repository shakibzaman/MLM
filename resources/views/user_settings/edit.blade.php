@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')

@section('content')

<div class="card text-bg-theme mb-2">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ !empty($title) ? $title : 'User Setting' }}</h4>
        <div>
            <a href="{{ route('user_settings.user_setting.index') }}" class="btn btn-primary"
                title="Show All User Setting">
                <span class="fa-solid fa-table-list" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>

<div class="card">
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
            action="{{ route('user_settings.user_setting.update', $userSetting->id) }}" id="edit_user_setting_form"
            name="edit_user_setting_form" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('user_settings.form', [
            'userSetting' => $userSetting,
            ])

            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                <input class="p-2 rounded btn-primary" type="submit" value="Update">
            </div>
        </form>

    </div>
</div>

@endsection