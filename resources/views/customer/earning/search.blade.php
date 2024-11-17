@extends('layouts/layoutMaster')

@section('title', 'Search income')

@section('content')


  <div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
      <h4 class="m-0">Search income</h4>
    </div>
    <div class="card-body">
      <form action="">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-4">
            <label for="exampleFormControlSelect1" class="form-label">Example select</label>
            <select name="type" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
              <option selected value="">All</option>
              <option value="referral income">Referral income</option>
              <option value="self purchase commission">Self purchase commission</option>
              <option value="repurchase commission">Repurchase commission</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-4">
            <label for="html5-date-input" class="form-label">Start Date</label>
            <input name="start_date" class="form-control" type="date" id="html5-date-input">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-4">
            <label for="html5-date-inputs" class="form-label">End Date</label>
            <input name="end_date" class="form-control" type="date" id="html5-date-inputs">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-4">
            <label for="html5-date-input" class="form-label"></label>
            <button type="submit" class="btn btn-primary form-control">Search</button>
          </div>
        </div>
      </div>
      </form>
    </div>
    @if($earnings ==  null)

    @else
      <div class="card-body p-0">
        <div class="table-responsive">

          <table class="table table-striped ">
            <thead>
            <tr>
              <th>ID</th>
              <th>Amount</th>
              <th>Type</th>
              <th>Details</th>
              <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($earnings as $earning)
              <tr>
                <td>{{ $earning->id }}</td>
                <td>{{ $earning->amount }}</td>
                <td class="align-middle">{{ $earning->type }}</td>
                <td class="align-middle">{{ $earning->description }}</td>
                <td>{{ $earning->created_at->format('Y-m-d h:i A') }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>

        </div>
      </div>

    @endif

  </div>
@endsection
