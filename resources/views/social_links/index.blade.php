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
        <h4 class="m-0">Social Links</h4>
        <div>
            <a href="{{ route('social_links.social_link.create') }}" class="btn btn-secondary"
                title="Create New Social Link">
                <span class="fa-solid fa-plus" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($socialLinks) == 0)
    <div class="card-body text-center">
        <h4>No Social Links Available.</h4>
    </div>
    @else
    <div class="card-body p-0">
        <div class="table-responsive">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Link</th>
                        <th>Status</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socialLinks as $socialLink)
                    <tr>
                        <td class="align-middle">{{ $socialLink->name }}</td>
                        <td class="align-middle"><i class="{{ $socialLink->icon }}"></i> </td>
                        <td class="align-middle"> {{ $socialLink->link }}</td>
                        <td class="align-middle">
                            <span
                                class="text-white badge {{ $socialLink->status ==1 ?'bg-success':'bg-danger' }}">{{$socialLink->status
                                ==1 ?'Active':'Inactive' }}</span>
                        </td>

                        <td class="text-end">

                            <form method="POST"
                                action="{!! route('social_links.social_link.destroy', $socialLink->id) !!}"
                                accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-sm" role="group">
                                    {{-- <a href="{{ route('social_links.social_link.show', $socialLink->id ) }}"
                                        class="btn btn-info" title="Show Social Link">
                                        <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                    </a> --}}
                                    <a href="{{ route('social_links.social_link.edit', $socialLink->id ) }}"
                                        class="btn btn-primary" title="Edit Social Link">
                                        <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="Delete Social Link"
                                        onclick="return confirm(&quot;Click Ok to delete Social Link.&quot;)">
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

        {!! $socialLinks->links('pagination') !!}
    </div>

    @endif

</div>
@endsection