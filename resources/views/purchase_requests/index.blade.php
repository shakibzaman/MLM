@extends('layouts/layoutMaster')

@section('title', 'Purchase Requests')

@section('content')

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Purchase Requests</h4>

        </div>

        @if(count($purchaseRequests) == 0)
            <div class="card-body text-center">
                <h4>No Purchase Requests Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Request Type</th>
                            <th>Package</th>
                            <th>User</th>
                            <th>Status</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($purchaseRequests as $purchaseRequest)
                        <tr>
                            <td class="align-middle">{{ $purchaseRequest->request_type == 1 ? 'lifetime' : 'monthly'  }}</td>
                            <td class="align-middle">{{ optional($purchaseRequest->purchasable)->name }}</td>
                            <td class="align-middle">{{ optional($purchaseRequest->user)->name }}</td>
                            <td class="align-middle"><span class="badge bg-label-primary p-3">{{ $purchaseRequest->status }}</span></td>

                            <td class="text-end">

{{--                                <form method="POST" action="{!! route('purchase_requests.purchase_request.destroy', $purchaseRequest->id) !!}" accept-charset="UTF-8">--}}
{{--                                <input name="_method" value="DELETE" type="hidden">--}}
{{--                                {{ csrf_field() }}--}}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('purchase_requests.purchase_request.show', $purchaseRequest->id ) }}" class="btn btn-info" title="Show Purchase Request">
                                            Show
                                        </a>
                                      @if($purchaseRequest->status == 'pending')
                                        <a href="{{ route('purchase_requests.purchase_request.approve', $purchaseRequest->id ) }}" class="btn btn-primary" title="Edit Purchase Request">
                                            Accept
                                        </a>
                                        <a href="{{ route('purchase_requests.purchase_request.reject', $purchaseRequest->id ) }}" class="btn btn-danger" title="Edit Purchase Request">
                                            Reject
                                        </a>
                                      @endif
{{--                                        <button type="submit" class="btn btn-danger" title="Delete Purchase Request" onclick="return confirm(&quot;Click Ok to delete Purchase Request.&quot;)">--}}
{{--                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>--}}
{{--                                        </button>--}}
                                    </div>

{{--                                </form>--}}

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $purchaseRequests->links('pagination') !!}
        </div>

        @endif

    </div>
@endsection
