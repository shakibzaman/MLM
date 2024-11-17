@extends('layouts/layoutMaster')

@section('title', 'Sitemap Upload')

@section('content')
<div class="card p-2">
    <form action="{{ route('sitemap.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="sitemap">Upload Sitemap (.xml file)</label>
            <input type="file" class="form-control" name="sitemap" accept=".xml" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Upload Sitemap</button>
    </form>
</div>

@endsection