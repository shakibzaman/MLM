@extends('layouts/layoutMaster')

@section('title', 'Coupon list')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Coopons</h4>
            <div>
                <a href="{{ route('coopons.coopon.create') }}" class="btn btn-secondary" title="Create New Coopon">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        @if(count($coopons) == 0)
            <div class="card-body text-center">
                <h4>No Coopons Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Coopon</th>
                            <th>Expire Date</th>
                            <th>Is Active</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($coopons as $coopon)
                        <tr>
                            <td class="align-middle">{{ $coopon->coopon }}</td>
                            <td class="align-middle">{{ $coopon->expire_date }}</td>
                            <td class="align-middle">{{ ($coopon->is_active) ? 'Yes' : 'No' }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('coopons.coopon.destroy', $coopon->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('coopons.coopon.show', $coopon->id ) }}" class="btn btn-info" title="Show Coopon">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('coopons.coopon.edit', $coopon->id ) }}" class="btn btn-primary" title="Edit Coopon">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Coopon" onclick="return confirm(&quot;Click Ok to delete Coopon.&quot;)">
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

            {!! $coopons->links('pagination') !!}
        </div>

        @endif

    </div>
@endsection
