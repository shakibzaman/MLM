@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')
@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {!! session('success_message') !!}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">Seo Tools</h4>
        <div>
            <a href="{{ route('seo_tools.seo_tool.create') }}" class="btn btn-secondary" title="Create New Seo Tool">
                <span class="fa-solid fa-plus" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($seoTools) == 0)
    <div class="card-body text-center">
        <h4>No Seo Tools Available.</h4>
    </div>
    @else
    <div class="card-body p-0">
        <div class="table-responsive">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Google Analytics</th>
                        <th>Meta Tags</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seoTools as $seoTool)
                    <tr>
                        <td class="align-middle">{{ $seoTool->google_analytics }}</td>
                        <td class="align-middle">{{ $seoTool->meta_tags }}</td>

                        <td class="text-end">

                            <form method="POST" action="{!! route('seo_tools.seo_tool.destroy', $seoTool->id) !!}"
                                accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('seo_tools.seo_tool.show', $seoTool->id ) }}" class="btn btn-info"
                                        title="Show Seo Tool">
                                        <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('seo_tools.seo_tool.edit', $seoTool->id ) }}"
                                        class="btn btn-primary" title="Edit Seo Tool">
                                        <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="Delete Seo Tool"
                                        onclick="return confirm(&quot;Click Ok to delete Seo Tool.&quot;)">
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

        {!! $seoTools->links('pagination') !!}
    </div>

    @endif

</div>
@endsection