@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">Create New Seo Tool</h4>
        <div>
            <a href="{{ route('seo_tools.seo_tool.index') }}" class="btn btn-primary" title="Show All Seo Tool">
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

        <form method="POST" class="needs-validation" novalidate action="{{ route('seo_tools.seo_tool.store') }}"
            accept-charset="UTF-8" id="create_seo_tool_form" name="create_seo_tool_form">
            {{ csrf_field() }}
            @include ('seo_tools.form', [
            'seoTool' => null,
            ])

            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                <input class="p-2 rounded btn-primary" type="submit" value="Add">
            </div>

        </form>

    </div>
</div>

@endsection