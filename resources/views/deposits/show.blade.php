@extends('layouts/layoutMaster')

@section('title', 'Coupon list')

@section('content')
@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {!! session('success_message') !!}

    <button type="button" class="far fa-times btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Deposit' }}</h4>
        <div>
            <form method="POST" action="{!! route('deposits.deposit.destroy', $deposit->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                {{-- <a href="{{ route('deposits.deposit.edit', $deposit->id ) }}" class="btn btn-primary"
                    title="Edit Deposit">
                    {{ __('edit') }}
                </a> --}}

                <button type="submit" class="btn btn-danger" title="Delete Deposit"
                    onclick="return confirm(&quot;Click Ok to delete Deposit.?&quot;)">
                    {{ __('delete') }}
                </button>

                <a href="{{ route('deposits.deposit.index') }}" class="btn btn-primary" title="Show All Deposit">
                    {{ __('show_all_deposit') }}

                </a>
                @can('customer-menu')
                <a href="{{ route('user.deposits.deposit.create') }}" class="btn-secondary" title="Create New Deposit">
                    {{ __('create_new_deposit') }}
                </a>
                @endcan

            </form>
        </div>
    </div>
    @php
    $statuses = array_flip( config('app.statuses'));
    $gateways = config('payment.gateway');
    @endphp
    <div class="card-body">
        <table class="table table-border table-stripe">
            <tbody>
                <tr>
                    <th>{{ __('date') }}</th>
                    <td>{{ ($deposit->created_at) }}</td>
                </tr>
                <tr>
                    <th>{{ __('system_hash') }}</th>
                    <td>{{ ($deposit->hash_id) }}</td>
                </tr>
                <tr>
                    <th>{{ __('customer') }}</th>
                    <td>{{ ($deposit->customer->name) }}</td>
                </tr>
                <tr>
                    <th>{{ __('amount') }}</th>
                    <td>{{ $deposit->amount }}</td>
                </tr>
                <tr>
                    <th>{{ __('transaction') }}</th>
                    <td>{{ ($deposit->transaction_id) }}</td>
                </tr>
                <tr>
                    <th>{{ __('gateway') }}</th>
                    <td>
                        {{ $gateways[$deposit->gateway] ?? 'N/A'}}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('status') }}</th>
                    <td
                        class="text-white {{ $deposit->status=='2'?'bg-success':($deposit->status=='3'?'bg-danger':'bg-primary') }}">

                        {{ strtoupper($statuses[$deposit->status]) }}</td>
                </tr>
                @if(($deposit->status_change_by !=null) )
                <tr>
                    <th>{{ __('status_change_by') }}</th>
                    <td>{{strtoupper($deposit->changedby->username) }}</td>
                </tr>
                <tr>
                    <th>{{ __('status_change_date') }}</th>
                    <td>{{strtoupper($deposit->status_change_date) }}</td>
                </tr>
                @endif
            </tbody>
        </table>
        @if($deposit->status=='1')
        <form action="{{ route('deposits.deposit.update', $deposit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button class="btn btn-success" type="submit" name="status" value="2">{{ __('approved') }}</button>
            <button class="btn btn-danger" type="submit" name="status" value="3">{{ __('reject') }}</button>

        </form>
        @endif
    </div>
</div>

@endsection