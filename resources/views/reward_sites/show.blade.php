@extends('layouts/layoutMaster')

@section('title', 'Fund Transfer')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($rewardSite->name) ? $rewardSite->name : 'Reward Site' }}</h4>
        <div>
            <form method="POST" action="{!! route('reward_sites.reward_site.destroy', $rewardSite->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('reward_sites.reward_site.edit', $rewardSite->id ) }}" class="btn btn-primary"
                    title="Edit Reward Site">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Reward Site"
                    onclick="return confirm(&quot;Click Ok to delete Reward Site.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('reward_sites.reward_site.index') }}" class="btn btn-primary"
                    title="Show All Reward Site">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('reward_sites.reward_site.create') }}" class="btn btn-secondary"
                    title="Create New Reward Site">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rewardSite->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Url</dt>
            <dd class="col-lg-10 col-xl-9">{{ $rewardSite->url }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Is Active</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($rewardSite->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection