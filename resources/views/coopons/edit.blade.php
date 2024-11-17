@extends('layouts/layoutMaster')

@section('title', 'Edit coupon')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ !empty($title) ? $title : 'Coopon' }}</h4>
        <div>
            <a href="{{ route('coopons.coopon.index') }}" class="btn btn-primary" title="Show All Coopon">
                <span class="fa-solid fa-table-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('coopons.coopon.create') }}" class="btn btn-secondary" title="Create New Coopon">
                <span class="fa-solid fa-plus" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    <div class="card-body">


        <form method="POST" class="needs-validation" novalidate
            action="{{ route('coopons.coopon.update', $coopon->id) }}" id="edit_coopon_form" name="edit_coopon_form"
            accept-charset="UTF-8">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('coopons.form', [
            'coopon' => $coopon,
            ])

            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
              <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>

    </div>
</div>

@endsection
