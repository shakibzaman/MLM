@extends('layouts/layoutMaster')

@section('title', 'Diposit Add')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ __('create_new_deposit') }}</h4>
        <div>
            <a href="{{ route('user.deposits.deposit.list') }}" class="btn btn-primary" title="Show All Deposit">{{
                __('show_previous_deposit') }}
                <span class="fas fa-list-alt" aria-hidden="true"></span>
            </a>
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

        <form method="POST" class="needs-validation" novalidate action="{{ route('deposits.deposit.store') }}"
            accept-charset="UTF-8" id="create_deposit_form" name="create_deposit_form">
            {{ csrf_field() }}
            @include ('deposits.form', [
            'deposit' => null,
            ])
            @if($permissionSetting->user_deposit)
            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                <button class="btn-primary btn" type="submit" value="Add">Payment</button>
            </div>
            @else
            <p class="text-danger"><strong>Currently Deposit is disabled. Please Contact with Support</strong></p>
            @endif

        </form>

    </div>
</div>

@endsection