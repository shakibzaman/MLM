@extends('layouts/layoutMaster')

@section('title', 'SItemap List')

@section('content')
<div class="container">
    <div class="card mb-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Sitemap List</h4>
            <a href="{{ route('sitemap.upload.form') }}" class="btn btn-success">
                Upload Sitemap
            </a>
        </div>
    </div>



    <div class="card p-2">
        @if (count($files) > 0)
        <ul class="list-group">
            @foreach ($files as $file)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ basename($file) }}
                <a href="{{ route('sitemap.download', basename($file)) }}" class="btn btn-sm btn-primary">
                    Download
                </a>
                <a href="{{ route('sitemap.delete', basename($file)) }}" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this sitemap?');">
                    Delete
                </a>
            </li>
            @endforeach
        </ul>
        @else
        <div class="alert alert-warning mt-3">
            No sitemaps found.
        </div>
        @endif
    </div>

</div>
@endsection