@extends('layouts/layoutMaster')

@section('title', 'Create Coupon')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">Create New Coupon</h4>
        <div>
            <a href="{{ route('coupons.coupon.index') }}" class="btn btn-primary" title="Show All Coupon">
                <span class="fa-solid fa-table-list" aria-hidden="true"></span>
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

        <form method="POST" class="needs-validation" novalidate action="{{ route('coupons.coupon.store') }}"
            accept-charset="UTF-8" id="create_coupon_form" name="create_coupon_form">
            {{ csrf_field() }}
            @include ('coupons.form', [
            'coupon' => null,
            ])

            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                <input class="p-2 btn-primary" type="submit" value="Add">
            </div>

        </form>

    </div>
</div>

@endsection