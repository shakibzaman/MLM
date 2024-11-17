@extends('layouts/layoutMaster')

@section('title', 'Fund Transfer')
@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($rewardSubmitType->name) ? $rewardSubmitType->name : 'Reward Submit Type' }}</h4>
        <div>
            <form method="POST"
                action="{!! route('reward_submit_types.reward_submit_type.destroy', $rewardSubmitType->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('reward_submit_types.reward_submit_type.edit', $rewardSubmitType->id ) }}"
                    class="btn btn-primary" title="Edit Reward Submit Type">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Reward Submit Type"
                    onclick="return confirm(&quot;Click Ok to delete Reward Submit Type.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('reward_submit_types.reward_submit_type.index') }}" class="btn btn-primary"
                    title="Show All Reward Submit Type">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('reward_submit_types.reward_submit_type.create') }}" class="btn btn-secondary"
                    title="Create New Reward Submit Type">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rewardSubmitType->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Is Active</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($rewardSubmitType->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection