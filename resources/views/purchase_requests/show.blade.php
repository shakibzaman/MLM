@extends('layouts/layoutMaster')

@section('title', 'Purchase Requests')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Purchase Request' }}</h4>

    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Request Type</dt>
            <dd class="col-lg-10 col-xl-9">{{ $purchaseRequest->request_type == 1 ? "Lifetime" : "Monthly" }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Request Package</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($purchaseRequest->purchasable)->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">User</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($purchaseRequest->user)->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $purchaseRequest->status }}</dd>

        </dl>

    </div>
</div>

@endsection
