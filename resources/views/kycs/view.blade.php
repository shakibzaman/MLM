@extends('layouts/layoutMaster')

@section('title', 'Show KYCS')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Kyc' }}</h4>
        @if(! $customer->kyc)
        <div>
            <a href="{{ route('customer-kyc-create') }}" class="btn btn-success" title="Create New Kyc">{{
                __('upload_kyc') }}
                <i class="fas fa-plus-square"></i>
            </a>
        </div>
        @endif
    </div>
    @if($customer->kyc)
    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('document_type') }}</dt>
            <dd class="col-lg-10 col-xl-9">
                {{ array_search($customer->kyc->document_type, config('app.document_types')) }}
            </dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('document_number') }}</dt>
            <dd class="col-lg-10 col-xl-9">{{ $customer->kyc->document_number }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('image') }}</dt>
            <dd class="col-lg-10 col-xl-9">
                <img src="{{ asset('storage/' . $customer->kyc->image) }}" alt="kyc image" width="50%" class="border">

            </dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('status') }}</dt>
            <dd class="col-lg-10 col-xl-9">{{ $customer->kyc->status }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('uploaded_at') }}</dt>
            <dd class="col-lg-10 col-xl-9">{{ $customer->kyc->created_at }}</dd>

        </dl>
        @if($customer->status != 'approved')
        <a href="{{ route('user-kyc-edit',$customer->kyc->id) }}" class="btn btn-primary">Update</a>
        @endif

    </div>
    @endif
</div>

@endsection