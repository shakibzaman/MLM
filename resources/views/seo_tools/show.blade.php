@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Seo Tool' }}</h4>
        <div>
            <form method="POST" action="{!! route('seo_tools.seo_tool.destroy', $seoTool->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('seo_tools.seo_tool.edit', $seoTool->id ) }}" class="btn btn-primary" title="Edit Seo Tool">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Seo Tool" onclick="return confirm(&quot;Click Ok to delete Seo Tool.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('seo_tools.seo_tool.index') }}" class="btn btn-primary" title="Show All Seo Tool">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('seo_tools.seo_tool.create') }}" class="btn btn-secondary" title="Create New Seo Tool">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Google Analytics</dt>
            <dd class="col-lg-10 col-xl-9">{{ $seoTool->google_analytics }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Meta Tags</dt>
            <dd class="col-lg-10 col-xl-9">{{ $seoTool->meta_tags }}</dd>

        </dl>

    </div>
</div>

@endsection