@extends('layouts/layoutMaster')

@section('title', 'Support ticket list')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Support Ticket Answer' }}</h4>
        <div>
            <form method="POST" action="{!! route('support_ticket_answers.support_ticket_answer.destroy', $supportTicketAnswer->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('support_ticket_answers.support_ticket_answer.edit', $supportTicketAnswer->id ) }}" class="btn btn-primary" title="Edit Support Ticket Answer">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Support Ticket Answer" onclick="return confirm(&quot;Click Ok to delete Support Ticket Answer.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('support_ticket_answers.support_ticket_answer.index') }}" class="btn btn-primary" title="Show All Support Ticket Answer">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('support_ticket_answers.support_ticket_answer.create') }}" class="btn btn-secondary" title="Create New Support Ticket Answer">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Support Ticket</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($supportTicketAnswer->supportTicket)->title }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Answer</dt>
            <dd class="col-lg-10 col-xl-9">{{ $supportTicketAnswer->answer }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">User</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($supportTicketAnswer->user)->name }}</dd>

        </dl>

    </div>
</div>

@endsection
