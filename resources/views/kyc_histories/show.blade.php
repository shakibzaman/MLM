@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Kyc History' }}</h4>
        <div>
            <form method="POST" action="{!! route('kyc_histories.kyc_history.destroy', $kycHistory->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('kyc_histories.kyc_history.edit', $kycHistory->id ) }}" class="btn btn-primary" title="Edit Kyc History">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Kyc History" onclick="return confirm(&quot;Click Ok to delete Kyc History.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('kyc_histories.kyc_history.index') }}" class="btn btn-primary" title="Show All Kyc History">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('kyc_histories.kyc_history.create') }}" class="btn btn-secondary" title="Create New Kyc History">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Customer</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($kycHistory->customer)->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Kyc</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($kycHistory->kyc)->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $kycHistory->status }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Created By</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($kycHistory->creator)->name }}</dd>

        </dl>

    </div>
</div>

@endsection