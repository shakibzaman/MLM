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
            <h4 class="m-0">Support Tickets</h4>
        </div>

        @if(count($supportTickets) == 0)
            <div class="card-body text-center">
                <h4>No Support Tickets Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Date posted</th>
                            <th>From</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>Is Active</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($supportTickets as $supportTicket)
                        <tr>
                            <td>{{ $supportTicket->created_at->format('mm-yy-dd') }}</td>
                            <td>{{ $supportTicket->user?->name }}</td>
                            <td class="align-middle">{{ $supportTicket->title }}</td>
                            <td class="align-middle">{{ $supportTicket->status }}</td>
                            <td>{{ $supportTicket->department }}</td>
                            <td class="align-middle">{{ ($supportTicket->is_active) ? 'Yes' : 'No' }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('user.support_tickets.support_ticket.destroy', $supportTicket->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('user.support_tickets.support_ticket.show', $supportTicket->id ) }}" class="btn btn-info" title="Show Support Ticket">
                                            Show
                                        </a>
                                        <a href="{{ route('user.support_tickets.support_ticket.edit', $supportTicket->id ) }}" class="btn btn-primary" title="Edit Support Ticket">
                                            Edit
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Support Ticket" onclick="return confirm(&quot;Click Ok to delete Support Ticket.&quot;)">
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

            {!! $supportTickets->links('pagination') !!}
        </div>

        @endif

    </div>
@endsection
