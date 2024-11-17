@extends('layouts/layoutMaster')

@section('title', 'Support ticket list')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Support Ticket Answers</h4>
            <div>
                <a href="{{ route('support_ticket_answers.support_ticket_answer.create') }}" class="btn btn-secondary" title="Create New Support Ticket Answer">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        @if(count($supportTicketAnswers) == 0)
            <div class="card-body text-center">
                <h4>No Support Ticket Answers Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Support Ticket</th>
                            <th>Answer</th>
                            <th>User</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($supportTicketAnswers as $supportTicketAnswer)
                        <tr>
                            <td class="align-middle">{{ optional($supportTicketAnswer->supportTicket)->title }}</td>
                            <td class="align-middle">{{ $supportTicketAnswer->answer }}</td>
                            <td class="align-middle">{{ optional($supportTicketAnswer->user)->name }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('support_ticket_answers.support_ticket_answer.destroy', $supportTicketAnswer->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('support_ticket_answers.support_ticket_answer.show', $supportTicketAnswer->id ) }}" class="btn btn-info" title="Show Support Ticket Answer">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('support_ticket_answers.support_ticket_answer.edit', $supportTicketAnswer->id ) }}" class="btn btn-primary" title="Edit Support Ticket Answer">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Support Ticket Answer" onclick="return confirm(&quot;Click Ok to delete Support Ticket Answer.&quot;)">
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

            {!! $supportTicketAnswers->links('pagination') !!}
        </div>

        @endif

    </div>
@endsection
