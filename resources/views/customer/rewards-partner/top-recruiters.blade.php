@extends('layouts/layoutMaster')

@section('title', 'Top recruiters')

@section('content')

  @if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible" role="alert">
      {!! session('success_message') !!}

      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
      <h4 class="m-0">Top recruiters</h4>
    </div>

    @if(count($customers) == 0)
      <div class="card-body text-center">
        <h4>No Subscriber Available.</h4>
      </div>
    @else
      <div class="card-body p-0">
        <div class="table-responsive">

          <table class="table table-striped ">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Total subscribers</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
              <tr>
                <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->index + 1 }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->subscribers_count }}</td>
                <td><a href="#" data-customer-id="{{ $customer->id }}" data-bs-toggle="modal" data-bs-target="#modalCenter" class="btn btn-facebook">Give reward</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>

        </div>

        {!! $customers->links('pagination') !!}
      </div>

    @endif

  </div>

  <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{ route('give-reward') }}" method="POST" accept-charset="UTF-8">
          @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Give reward</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-4">
              <label for="nameWithTitle" class="form-label">Amount</label>
              <input
                type="number"
                min="0"
                name="amount"
                id="nameWithTitle"
                class="form-control"
                placeholder="Enter amount" />

              <input type="hidden" name="user_id" id="customerIdInput" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Add an event listener to capture when the modal is about to be shown
    var modal = document.getElementById('modalCenter');
    modal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget;

      // Extract customer ID from the data attribute
      var customerId = button.getAttribute('data-customer-id');

      // Set the customer ID in the hidden input inside the modal
      var inputCustomerId = document.getElementById('customerIdInput');
      inputCustomerId.value = customerId;
    });
  </script>
@endsection
