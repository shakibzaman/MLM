@extends('layouts/layoutMaster')

@section('title', 'Country details')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($country->name) ? $country->name : 'Country' }}</h4>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $country->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Short Code</dt>
            <dd class="col-lg-10 col-xl-9">{{ $country->short_code }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Flag</dt>
            <dd class="col-lg-10 col-xl-9"><img width="100px" src="{{ asset('storage') }}/{{ $country->flag }}" /></dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Is Active</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($country->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection
