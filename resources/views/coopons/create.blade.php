@extends('layouts/layoutMaster')

@section('title', 'Create coupon')

@section('content')
    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Create New Coopon</h4>
            <div>
                <a href="{{ route('coopons.coopon.index') }}" class="btn btn-primary" title="Show All Coopon">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>
            </div>
        </div>


        <div class="card-body">

            <form method="POST" class="needs-validation" novalidate action="{{ route('coopons.coopon.store') }}" accept-charset="UTF-8" id="create_coopon_form" name="create_coopon_form" >
            {{ csrf_field() }}
            @include ('coopons.form', [
                                        'coopon' => null,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>

            </form>

        </div>
    </div>

@endsection


