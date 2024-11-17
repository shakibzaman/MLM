@extends('layouts/layoutMaster')

@section('title', 'All Coupon')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Coupons</h4>
            <div>
                <a href="{{ route('coupons.coupon.create') }}" class="btn btn-secondary" title="Create New Coupon">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($coupons) == 0)
            <div class="card-body text-center">
                <h4>No Coupons Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Validate Date</th>
                            <th>Validate User Limit</th>
                            <th>Point Amount</th>
                            <th>Is Active</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $coupon)
                        <tr>
                            <td class="align-middle">{{ $coupon->name }}</td>
                            <td class="align-middle">{{ $coupon->code }}</td>
                            <td class="align-middle">{{ $coupon->validate_date }}</td>
                            <td class="align-middle">{{ $coupon->validate_user_limit }}</td>
                            <td class="align-middle">{{ $coupon->point_amount }}</td>
                            <td class="align-middle">{{ ($coupon->is_active) ? 'Yes' : 'No' }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('coupons.coupon.destroy', $coupon->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('coupons.coupon.show', $coupon->id ) }}" class="btn btn-info" title="Show Coupon">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('coupons.coupon.edit', $coupon->id ) }}" class="btn btn-primary" title="Edit Coupon">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Coupon" onclick="return confirm(&quot;Click Ok to delete Coupon.&quot;)">
                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $coupons->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection