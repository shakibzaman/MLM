@extends('layouts/layoutMaster')

@section('title', 'Show KYCS')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Kyc' }}</h4>
        <div>
            <form method="POST" action="{!! route('customer-kyc-destroy', $kyc->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('customer-kyc-edit', $kyc->id ) }}" class="btn btn-primary" title="Edit Kyc">
                    <i class="far fa-edit"></i>
                </a>


                <button type="submit" class="btn btn-danger" title="Delete Kyc"
                    onclick="return confirm(&quot;Click Ok to delete Kyc.?&quot;)">
                    <i class="fas fa-trash-alt"></i>
                </button>

                <a href="{{ route('customer-kyc-index') }}" class="btn btn-primary" title="Show All Kyc">
                    <i class="fas fa-list-alt"></i>
                </a>

                {{-- <a href="{{ route('kycs.kyc.create') }}" class="btn btn-secondary" title="Create New Kyc">
                    <i class="fas fa-plus-square"></i>
                </a> --}}

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Customer</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($kyc->customer)->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Document Type</dt>
            <dd class="col-lg-10 col-xl-9">
                {{ array_search($kyc->document_type, config('app.document_types')) }}
            </dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Document Number</dt>
            <dd class="col-lg-10 col-xl-9">{{ $kyc->document_number }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Image</dt>
            <dd class="col-lg-10 col-xl-9">
                <img src="{{ asset('storage/' . $kyc->image) }}" alt="kyc image" width="50%">

            </dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $kyc->status }}</dd>

        </dl>

    </div>
    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">Kyc History</h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Creator</th>
                    <th>Date</th>
                </tr>

            </thead>
            <tbody>
                @foreach($kyc->histories as $history)
                <tr>
                    <td>{{ $history->id }}</td>
                    <td>{{ $history->status }}</td>
                    <td>{{ $history->creator->name }}</td>
                    <td>{{ $history->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection