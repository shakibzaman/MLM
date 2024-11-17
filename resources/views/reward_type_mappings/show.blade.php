@extends('layouts/layoutMaster')

@section('title', 'Fund Transfer')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Reward Type Mapping' }}</h4>
        <div>
            <form method="POST"
                action="{!! route('reward_type_mappings.reward_type_mapping.destroy', $rewardTypeMapping->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('reward_type_mappings.reward_type_mapping.edit', $rewardTypeMapping->id ) }}"
                    class="btn btn-primary" title="Edit Reward Type Mapping">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Reward Type Mapping"
                    onclick="return confirm(&quot;Click Ok to delete Reward Type Mapping.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('reward_type_mappings.reward_type_mapping.index') }}" class="btn btn-primary"
                    title="Show All Reward Type Mapping">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('reward_type_mappings.reward_type_mapping.create') }}" class="btn btn-secondary"
                    title="Create New Reward Type Mapping">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Reward Site</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($rewardTypeMapping->rewardSite)->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Reward Submit Type</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($rewardTypeMapping->rewardSubmitType)->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Reward Amount</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rewardTypeMapping->reward_amount }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Is Active</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($rewardTypeMapping->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection