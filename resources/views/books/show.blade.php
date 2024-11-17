@extends('layouts/layoutMaster')

@section('title', 'Books')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Book' }}</h4>
        <div>
            <form method="POST" action="{!! route('books.book.destroy', $book->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('books.book.edit', $book->id ) }}" class="btn btn-primary" title="Edit Book">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Book" onclick="return confirm(&quot;Click Ok to delete Book.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('books.book.index') }}" class="btn btn-primary" title="Show All Book">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('books.book.create') }}" class="btn btn-secondary" title="Create New Book">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Lang</dt>
            <dd class="col-lg-10 col-xl-9">{{ ucfirst($book->lang) }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">File</dt>
            <dd class="col-lg-10 col-xl-9"><a target="_blank" href="{{ asset('storage/' . $book->file) }}">Click</a></dd>

        </dl>

    </div>
</div>

@endsection
