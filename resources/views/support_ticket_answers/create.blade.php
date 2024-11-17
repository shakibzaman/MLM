@extends('layouts/layoutMaster')

@section('title', 'Support ticket list')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Create New Support Ticket Answer</h4>
            <div>
                <a href="{{ route('support_ticket_answers.support_ticket_answer.index') }}" class="btn btn-primary" title="Show All Support Ticket Answer">
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

            <form method="POST" class="needs-validation" novalidate action="{{ route('support_ticket_answers.support_ticket_answer.store') }}" accept-charset="UTF-8" id="create_support_ticket_answer_form" name="create_support_ticket_answer_form" >
            {{ csrf_field() }}
            @include ('support_ticket_answers.form', [
                                        'supportTicketAnswer' => null,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Add">
                </div>

            </form>

        </div>
    </div>

@endsection


