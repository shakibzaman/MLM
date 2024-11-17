@extends('layouts/layoutMaster')

@section('title', 'Edit country')

@section('content')
    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">{{ !empty($country->name) ? $country->name : 'Country' }}</h4>
            <div>
                <a href="{{ route('countries.country.index') }}" class="btn btn-primary" title="Show All Country">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('countries.country.create') }}" class="btn btn-secondary" title="Create New Country">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
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

            <form method="POST" class="needs-validation" novalidate action="{{ route('countries.country.update', $country->id) }}" id="edit_country_form" name="edit_country_form" accept-charset="UTF-8"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('countries.form', [
                                        'country' => $country,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                  <button class="btn btn-primary" type="submit" value="Update">Update</button>
                </div>
            </form>

        </div>
    </div>

@endsection
