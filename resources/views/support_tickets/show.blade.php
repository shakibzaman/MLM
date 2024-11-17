@extends('layouts/layoutMaster')

@section('title', 'Support ticket list')

@section('content')
<div class="card text-bg-theme">
    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($supportTicket->title) ? $supportTicket->title : 'Support Ticket' }}</h4>
    </div>

    <div class="card-body mb-4">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Title</dt>
            <dd class="col-lg-10 col-xl-9">{{ $supportTicket->title }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Description</dt>
            <dd class="col-lg-10 col-xl-9">{{ $supportTicket->description }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $supportTicket->status }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Is Active</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($supportTicket->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>
<h3>Ticket thread</h3>
@foreach($supportTicket->answers as $answer)
  <div class="card mt-2">
    <div class="card-header"><h4 class="float-left">{{ $answer->user->username }}</h4> <span class="float-right">{{ $answer->created_at }}</span></div>
    <div class="card-body">
      {{ $answer->answer }}
    </div>
  </div>
@endforeach
@if($supportTicket->status != "closed")
  <div class="card mt-2">
    <div class="card-body mt-2">
      <form method="POST" class="needs-validation" novalidate action="{{ route('support_ticket_answers.support_ticket_answer.store') }}" accept-charset="UTF-8" id="create_support_ticket_answer_form" name="create_support_ticket_answer_form" >
        {{ csrf_field() }}
        <input type="hidden" name="support_ticket_id" value="{{ $supportTicket->id }}" />

        <div class="mb-3 row">
          <label for="answer" class="col-form-label text-lg-end col-lg-2 col-xl-3">Answer</label>
          <div class="col-lg-10 col-xl-9">
            <textarea class="form-control {{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" id="answer"  minlength="1" placeholder="Enter answer here..."></textarea>
            {!! $errors->first('answer', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
          <button class="btn btn-primary" type="submit">Answer</button>
        </div>

      </form>
    </div>
  </div>
@endif
@endsection
