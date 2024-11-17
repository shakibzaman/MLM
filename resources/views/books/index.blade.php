@extends('layouts/layoutMaster')

@section('title', 'Books')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Books</h4>
            <div>
                <a href="{{ route('books.book.create') }}" class="btn btn-secondary" title="Create New Book">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        @if(count($books) == 0)
            <div class="card-body text-center">
                <h4>No Books Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Language</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td class="align-middle">{{ ucfirst($book->lang) }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('books.book.destroy', $book->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('books.book.show', $book->id ) }}" class="btn btn-info" title="Show Book">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('books.book.edit', $book->id ) }}" class="btn btn-primary" title="Edit Book">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Book" onclick="return confirm(&quot;Click Ok to delete Book.&quot;)">
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

            {!! $books->links('pagination') !!}
        </div>

        @endif

    </div>
@endsection
