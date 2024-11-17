@extends('layouts/layoutMaster')

@section('title', 'Show Coupon')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($coupon->name) ? $coupon->name : 'Coupon' }}</h4>
        <div>
            <form method="POST" action="{!! route('coupons.coupon.destroy', $coupon->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('coupons.coupon.edit', $coupon->id ) }}" class="btn btn-primary" title="Edit Coupon">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Coupon"
                    onclick="return confirm(&quot;Click Ok to delete Coupon.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('coupons.coupon.index') }}" class="btn btn-primary" title="Show All Coupon">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('coupons.coupon.create') }}" class="btn btn-secondary" title="Create New Coupon">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Code</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->code }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Validate Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->validate_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Validate User Limit</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->validate_user_limit }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Point Amount</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->point_amount }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Is Active</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($coupon->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection