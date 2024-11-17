@extends('layouts/layoutMaster')

@section('title', 'Support ticket list')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">{{ !empty($title) ? $title : 'Support Ticket Answer' }}</h4>
            <div>
                <a href="{{ route('support_ticket_answers.support_ticket_answer.index') }}" class="btn btn-primary" title="Show All Support Ticket Answer">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('support_ticket_answers.support_ticket_answer.create') }}" class="btn btn-secondary" title="Create New Support Ticket Answer">
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

            <form method="POST" class="needs-validation" novalidate action="{{ route('support_ticket_answers.support_ticket_answer.update', $supportTicketAnswer->id) }}" id="edit_support_ticket_answer_form" name="edit_support_ticket_answer_form" accept-charset="UTF-8" >
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('support_ticket_answers.form', [
                                        'supportTicketAnswer' => $supportTicketAnswer,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>

        </div>
    </div>

@endsection
