@extends('layouts/layoutMaster')

@section('title', 'Fund Transfer')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Reward Type Mappings</h4>
            <div>
                <a href="{{ route('reward_type_mappings.reward_type_mapping.create') }}" class="btn btn-secondary" title="Create New Reward Type Mapping">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($rewardTypeMappings) == 0)
            <div class="card-body text-center">
                <h4>No Reward Type Mappings Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Reward Site</th>
                            <th>Reward Submit Type</th>
                            <th>Reward Amount</th>
                            <th>Is Active</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($rewardTypeMappings as $rewardTypeMapping)
                        <tr>
                            <td class="align-middle">{{ optional($rewardTypeMapping->rewardSite)->name }}</td>
                            <td class="align-middle">{{ optional($rewardTypeMapping->rewardSubmitType)->name }}</td>
                            <td class="align-middle">{{ $rewardTypeMapping->reward_amount }}</td>
                            <td class="align-middle">{{ ($rewardTypeMapping->is_active) ? 'Yes' : 'No' }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('reward_type_mappings.reward_type_mapping.destroy', $rewardTypeMapping->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('reward_type_mappings.reward_type_mapping.show', $rewardTypeMapping->id ) }}" class="btn btn-info" title="Show Reward Type Mapping">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('reward_type_mappings.reward_type_mapping.edit', $rewardTypeMapping->id ) }}" class="btn btn-primary" title="Edit Reward Type Mapping">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Reward Type Mapping" onclick="return confirm(&quot;Click Ok to delete Reward Type Mapping.&quot;)">
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

            {!! $rewardTypeMappings->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection