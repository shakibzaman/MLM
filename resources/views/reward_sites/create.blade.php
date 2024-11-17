@extends('layouts/layoutMaster')

@section('title', 'Fund Transfer')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">Create New Reward Site</h4>
        <div>
            <a href="{{ route('reward_sites.reward_site.index') }}" class="btn btn-primary"
                title="Show All Reward Site">
                <span class="fa-solid fa-table-list" aria-hidden="true"></span>
            </a>
        </div>
    </div>


    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" class="needs-validation" novalidate action="{{ route('reward_sites.reward_site.store') }}"
            accept-charset="UTF-8" id="create_reward_site_form" name="create_reward_site_form">
            {{ csrf_field() }}
            @include ('reward_sites.form', [
            'rewardSite' => null,
            ])

            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                <input class="btn-primary" type="submit" value="Add">
            </div>

        </form>

    </div>
</div>

@endsection