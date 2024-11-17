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
      <h4 class="m-0">{{ __('Transaction') }}</h4>
    </div>

    <div class="card-body mb-4">
      <dl class="row">
        <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('date') }}</dt>
        <dd class="col-lg-10 col-xl-9">{{ $transaction->created_at->format(' Y m d') }}</dd>
        <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('Status')}}</dt>
        <dd class="col-lg-10 col-xl-9">{{ $transaction->status }}</dd>
        <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('Amount')}}</dt>
        <dd class="col-lg-10 col-xl-9">{{ $transaction->amount }}</dd>
        <dt class="text-lg-end col-lg-2 col-xl-3">{{ __('Action') }}</dt>
        <dd class="col-lg-10 col-xl-9">{{ ($transaction->action) }}</dd>

      </dl>

    </div>
  </div>

@endsection
