@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')

@section('content')
@php
use Illuminate\Support\Facades\Session;
@endphp

@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {!! session('success_message') !!}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ __('kycs') }}</h4>
    </div>

    @if(count($kycs) == 0)
    <div class="card-body text-center">
        <h4>{{ __('no_kyc') }}</h4>
    </div>
    @else
    <div class="card-body p-0">
        <div class="table-responsive">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>{{ __('id') }}</th>
                        <th>{{ __('customer') }}</th>
                        <th>{{ __('document_type') }}</th>
                        <th>{{ __('document_number') }}</th>
                        <th>{{ __('status') }}</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kycs as $kyc)
                    <tr>
                        <td class="align-middle">{{ $kyc->id }}</td>
                        <td class="align-middle">{{ optional($kyc->customer)->name }}</td>
                        <td class="align-middle">
                            {{ array_search($kyc->document_type, config('app.document_types')) ?? 'N/A' }}
                        </td>
                        <td class="align-middle">{{ $kyc->document_number }}</td>
                        <td class="align-middle">{{ $kyc->status }}</td>

                        <td class="text-end">

                            <form method="POST" action="{!! route('customer-kyc-destroy', $kyc->id) !!}"
                                accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('customer-kyc-show', $kyc->id ) }}" class="btn btn-info"
                                        title="Show Kyc">
                                        <span class="fas fa-external-link-alt" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('customer-kyc-edit', $kyc->id ) }}" class="btn btn-primary"
                                        title="Edit Kyc">
                                        <span class="far fa-edit" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="Delete Kyc"
                                        onclick="return confirm(&quot;Click Ok to delete Kyc.&quot;)">
                                        <span class="far fa-trash-alt" aria-hidden="true"></span>
                                    </button>
                                </div>

                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        {!! $kycs->links('pagination') !!}
    </div>

    @endif

</div>
@endsection