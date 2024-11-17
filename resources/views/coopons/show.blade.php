@extends('layouts/layoutMaster')

@section('title', 'Coupon details')

@section('content')
<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Coopon' }}</h4>
        <div>
            <form method="POST" action="{!! route('coopons.coopon.destroy', $coopon->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('coopons.coopon.edit', $coopon->id ) }}" class="btn btn-primary" title="Edit Coopon">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Coopon" onclick="return confirm(&quot;Click Ok to delete Coopon.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('coopons.coopon.index') }}" class="btn btn-primary" title="Show All Coopon">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('coopons.coopon.create') }}" class="btn btn-secondary" title="Create New Coopon">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Coopon</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coopon->coopon }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Expire Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coopon->expire_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Is Active</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($coopon->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection
