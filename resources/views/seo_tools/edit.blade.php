@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')

@section('content')

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ !empty($title) ? $title : 'Seo Tool' }}</h4>
        <div>

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
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form method="POST" class="needs-validation" novalidate
            action="{{ route('seo_tools.seo_tool.update', $seoTool->id) }}" id="edit_seo_tool_form"
            name="edit_seo_tool_form" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('seo_tools.form', [
            'seoTool' => $seoTool,
            ])

            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                <input class="p-2 rounded btn-primary" type="submit" value="Update">
            </div>
        </form>

    </div>
</div>

@endsection