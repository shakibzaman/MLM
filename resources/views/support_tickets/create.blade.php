@extends('layouts/layoutMaster')

@section('title', 'Support ticket list')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Create New Support Ticket</h4>
            <div>
                <a href="{{ route('support_tickets.support_ticket.index') }}" class="btn btn-primary" title="Show All Support Ticket">
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

            <form method="POST" class="needs-validation" novalidate action="{{ route('support_tickets.support_ticket.store') }}" accept-charset="UTF-8" id="create_support_ticket_form" name="create_support_ticket_form" >
            {{ csrf_field() }}
            @include ('support_tickets.form', [
                                        'supportTicket' => null,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>

@endsection


