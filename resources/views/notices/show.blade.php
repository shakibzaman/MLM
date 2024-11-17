@extends('layouts/layoutMaster')

@section('title', 'Notice details')

@section('content')
<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($notice->title) ? $notice->title : 'Notice' }}</h4>
        <div>
            <form method="POST" action="{!! route('notices.notice.destroy', $notice->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('notices.notice.edit', $notice->id ) }}" class="btn btn-primary" title="Edit Notice">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Notice" onclick="return confirm(&quot;Click Ok to delete Notice.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('notices.notice.index') }}" class="btn btn-primary" title="Show All Notice">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('notices.notice.create') }}" class="btn btn-secondary" title="Create New Notice">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Title</dt>
            <dd class="col-lg-10 col-xl-9">{{ $notice->title }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Description</dt>
            <dd class="col-lg-10 col-xl-9">{{ $notice->description }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Is Active</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($notice->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection
