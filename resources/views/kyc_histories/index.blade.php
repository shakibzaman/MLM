@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Kyc Histories</h4>
            <div>
                <a href="{{ route('kyc_histories.kyc_history.create') }}" class="btn btn-secondary" title="Create New Kyc History">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($kycHistories) == 0)
            <div class="card-body text-center">
                <h4>No Kyc Histories Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Kyc</th>
                            <th>Status</th>
                            <th>Created By</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($kycHistories as $kycHistory)
                        <tr>
                            <td class="align-middle">{{ optional($kycHistory->customer)->name }}</td>
                            <td class="align-middle">{{ optional($kycHistory->kyc)->created_at }}</td>
                            <td class="align-middle">{{ $kycHistory->status }}</td>
                            <td class="align-middle">{{ optional($kycHistory->creator)->name }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('kyc_histories.kyc_history.destroy', $kycHistory->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('kyc_histories.kyc_history.show', $kycHistory->id ) }}" class="btn btn-info" title="Show Kyc History">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('kyc_histories.kyc_history.edit', $kycHistory->id ) }}" class="btn btn-primary" title="Edit Kyc History">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Kyc History" onclick="return confirm(&quot;Click Ok to delete Kyc History.&quot;)">
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

            {!! $kycHistories->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection