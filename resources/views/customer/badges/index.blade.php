@extends('layouts/layoutMaster')

@section('title', 'Badges')

@section('content')
  <div class="container">
    <div class="card mb-6">
      <div class="card-header d-flex flex-wrap justify-content-between gap-4">
        <div class="card-title mb-0 me-1">
          <h5 class="mb-0">Badges</h5>
          <p class="mb-0">All of the badges you can earn</p>
        </div>
      </div>
      <div class="card-body">
        <div class="row gy-6 mb-6">
          @foreach($badges as $badge)
            <div class="col-sm-6 col-lg-4">
            <div class="card p-2 h-100 shadow-none border">
              <div class="rounded-2 text-center mb-4">
                <a href="#"><img width="100px" class="img-fluid" src="{{ asset('storage/' . $badge->badge) }}" alt="tutor image 1"></a>
              </div>
              <div class="card-body p-4 pt-2">
                <a href="#" class="h5">{{ $badge->name }}</a>
                <p class="highlight mt-4">Minimum referrals: {{ $badge->minimum_referrals }}</p>
                <p class="highlight">Direct referrals: {{ $badge->direct_referrals }}</p>
                <p class="highlight">Active subscribers: {{ $badge->active_subscribers }}</p>
                <p class="highlight">Earnings: {{ $badge->earnings }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>


@endsection

