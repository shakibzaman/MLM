@extends('layouts/layoutMaster')

@section('title', 'Coupon list')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ !empty($title) ? $title : 'Deposit' }}</h4>
        <div>
            <a href="{{ route('deposits.deposit.index') }}" class="btn btn-primary" title="Show All Deposit">
                {{ __('all ') }}
            </a>
            @can('customer-menu')
            <a href="{{ route('user.deposits.deposit.create') }}" class="btn btn-secondary" title="Create New Deposit">
                {{ __('create_new ') }}
            </a>
            @endcan
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
            action="{{ route('deposits.deposit.update', $deposit->id) }}" id="edit_deposit_form"
            name="edit_deposit_form" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('deposits.form', [
            'deposit' => $deposit,
            ])

            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                <input class="btn btn-primary" type="submit" value="Update">
            </div>
        </form>

    </div>
</div>

@endsection