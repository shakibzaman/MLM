@extends('layouts/layoutMaster')

@section('title', 'Deposits list')

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {!! session('success_message') !!}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0"> {{ __('deposit_list') }}</h4>
        @can('customer-menu')
        <div>
            <a href="{{ route('user.deposits.deposit.create') }}" class="btn btn-secondary" title="Create New Deposit">
                Add
            </a>
        </div>
        @endcan
    </div>

    @if(count($deposits) == 0)
    <div class="card-body text-center">
        <h4>{{ __('no_deposit') }}</h4>
    </div>
    @else
    <div class="card-body p-0">
        <div class="table-responsive">
            @php
            $statusLabels = array_flip(config('app.statuses'));
            @endphp
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>{{ __('date') }}</th>
                        <th>{{ __('system_hash') }}</th>
                        <th>{{ __('customer') }}</th>
                        <th>{{ __('amount') }}</th>
                        <th>{{ __('transaction') }}</th>
                        <th>{{ __('gateway') }}</th>
                        <th>{{ __('status') }}</th>
                        @can('admin-menu')
                        <th></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @php
                    $gateways = config('payment.gateway');

                    @endphp
                    @foreach($deposits as $deposit)
                    <tr>
                        <td class="align-middle">{{ ($deposit->created_at) }}</td>
                        <td class="align-middle">{{ ($deposit->hash_id) }}</td>
                        <td class="align-middle">{{ ($deposit->customer->name) }}</td>
                        <td class="align-middle">{{ $deposit->amount }}</td>
                        <td class="align-middle">{{ ($deposit->transaction_id) }}</td>
                        <td class="align-middle">{{ $gateways[$deposit->gateway] ?? 'N/A'}}</td>
                        <td class="align-middle ">
                            <span
                                class="{{ $deposit->status==1 ? 'bg-info' : ($deposit->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                                {{ strtoupper($statusLabels[$deposit->status] ?? 'N/A') }}
                            </span>
                        </td>
                        @can('admin-menu')
                        <td class="text-end">

                            <form method="POST" action="{!! route('deposits.deposit.destroy', $deposit->id) !!}"
                                accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('deposits.deposit.show', $deposit->id ) }}" class="btn btn-info"
                                        title="Show Deposit">
                                        Show
                                    </a>
                                    <button type="submit" class="btn btn-danger" title="Delete Deposit"
                                        onclick="return confirm(&quot;Click Ok to delete Deposit.&quot;)">
                                        Delete
                                    </button>
                                </div>

                            </form>

                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        {!! $deposits->links('pagination') !!}
    </div>

    @endif

</div>
@endsection