@extends('layouts/layoutMaster')

@section('title', 'All Notifications')

@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
'resources/assets/vendor/libs/select2/select2.scss'
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js',
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js'
])
@endsection

@section('content')

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {!! session('error') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme mb-4">
    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ $type }} Notifications</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if($notifications->count() > 0)
        <div class="card p-4">
            <ul class="list-group list-group-flush">
                @foreach ($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 mb-3"
                    style="background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <div>
                        <strong class="text-primary">{{ $notification->data['author'] }}</strong>:
                        <span>{{ $notification->data['title'] }}</span> </br>
                        <span><small> {{ $notification->data['description'] ?? null}}</small></span>
                        <em class="text-muted small">{{ $notification->created_at->diffForHumans() }}</em>
                    </div>
                    <div>
                        <a href="{{ $notification->data['link']}}" class="btn btn-primary btn-sm">Show</a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @else
        <div class="alert alert-info text-center" role="alert">
            No notifications found.
        </div>
        @endif
    </div>
</div>

@endsection