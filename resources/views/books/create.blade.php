@extends('layouts/layoutMaster')

@section('title', 'Books')


@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Upload New Book</h4>
            <div>
                <a href="{{ route('books.book.index') }}" class="btn btn-primary" title="Show All Book">
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

            <form method="POST" class="needs-validation" novalidate action="{{ route('books.book.store') }}" accept-charset="UTF-8" id="create_book_form" name="create_book_form"  enctype="multipart/form-data">
            {{ csrf_field() }}
            @include ('books.form', [
                                        'book' => null,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>

            </form>

        </div>
    </div>

@endsection


