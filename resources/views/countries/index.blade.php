@extends('layouts/layoutMaster')

@section('title', 'Country list')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Countries</h4>
            <div>
                <a href="{{ route('countries.country.create') }}" class="btn btn-secondary" title="Create New Country">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        @if(count($countries) == 0)
            <div class="card-body text-center">
                <h4>No Countries Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Short Code</th>
                            <th>Flag</th>
                            <th>Is Active</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($countries as $country)
                        <tr>
                            <td class="align-middle">{{ $country->name }}</td>
                            <td class="align-middle">{{ $country->short_code }}</td>
                            <td class="align-middle"><img width="20px" src="{{ asset('storage') }}/{{ $country->flag }}" /></td>
                            <td class="align-middle">{{ ($country->is_active) ? 'Yes' : 'No' }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('countries.country.destroy', $country->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('countries.country.show', $country->id ) }}" class="btn btn-info" title="Show Country">
                                            Show
                                        </a>
                                        <a href="{{ route('countries.country.edit', $country->id ) }}" class="btn btn-primary" title="Edit Country">
                                            Edit
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Country" onclick="return confirm(&quot;Click Ok to delete Country.&quot;)">
                                            Delete
                                        </button>
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $countries->links('pagination') !!}
        </div>

        @endif

    </div>
@endsection
