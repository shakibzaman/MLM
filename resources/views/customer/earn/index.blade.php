@extends('layouts/layoutMaster')

@section('title', 'Invite & Earn')

@section('content')

  <div class="card text-bg-theme">
    <div class="card-body p-3">
      <div class="row g-6">
        <div class="col-md-12">
          <h4 class="m-0">Referral Program</h4>
          <h5 class="m-0">Track and find all the details about our referral program, your stats and revenues.</h5>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card shadow-none bg-transparent border border-primary">
            <div class="card-body text-center">
              <h5 class="card-title text-primary">Earnings</h5>
              <p class="card-text text-primary">
                $ {{ auth()->user()->total_income }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card shadow-none bg-transparent border border-secondary">
            <div class="card-body text-center">
              <h5 class="card-title text-secondary">Direct Referrals</h5>
              <p class="card-text text-secondary">
                {{ $directreferral }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card shadow-none bg-transparent border border-success">
            <div class="card-body text-center">
              <h5 class="card-title text-success">Indirect Referrals</h5>
              <p class="card-text text-success">
                {{ $indirectreferral }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card shadow-none bg-transparent border border-danger">
            <div class="card-body text-center">
              <h5 class="card-title text-danger">Total Referrals</h5>
              <p class="card-text text-danger">
                {{ $totalreferral }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-10">
        <div class="col-md-5">
          <h4 class="mb-0">Referral Link</h4>
          <p>Copy the link bellow and share with your friends.</p>
          <div class="row">
            <div class="col-md-8 col-sm-12 pe-0 mb-md-0 mb-2">
              <input class="form-control" readonly id="clipboard-example" type="text" value="{{$referral}}">
            </div>
            <div class="col-md-4 col-sm-12">
              <button class="clipboard-btn btn btn-primary me-2 waves-effect waves-light" data-clipboard-action="copy" data-clipboard-target="#clipboard-example">
                Copy
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card text-bg-theme mt-5">
    <div class="card-header">
      <h4>Direct Referrals</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($directreferrals as $key => $referral)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $referral->name }}</td>
                <td>{{ $referral->email }}</td>
                <td>{{ $referral->created_at->format('d-m-Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
@endsection
@section('vendor-script')

  @vite([
  'resources/assets/vendor/libs/clipboard/clipboard.js',
  'resources/assets/js/extended-ui-misc-clipboardjs.js',

  ])
@stop
