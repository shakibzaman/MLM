@extends('layouts/layoutMaster')

@section('title',  __('switch_membership'))
@section('page-style')
  <!-- Page -->
  @vite([
  'resources/assets/vendor/libs/select2/select2.scss',
  ])
@endsection
@section('vendor-script')
  <script>
    $(document).ready(function() {
      // When the "Choose Plan" button is clicked, show the modal
      $('.open-modal').on('click', function() {
        // Get package data from button attributes
        var status = $(this).data('activation-status');

        // Set the modal package name and hidden input for the form
        $('#modal-package-name').text('Are you sure you want to change your monthly package activation status?');
        $('#status').val(status);

        // Show the modal
        $('#deleteModal').modal('show');
      });
    });
  </script>
@endsection
@section('content')
    <div class="card mt-5">
      <!-- Pricing Plans -->
      <div class="pb-4 rounded-top">
        <div class="container py-12 px-xl-10 px-4">
          @if(auth()->guard('customer')->user()->monthly_package == null)
            <h3 class="text-center mb-2 mt-0 mt-md-4">You did not purchase any monthly package yet</h3>
          @else
            <h3 class="text-center mb-2 mt-0 mt-md-4">Change your monthly package status</h3>
            <div class="row">
            <div class="col-md-12 mt-10">
                  <center>
                    @if(auth()->guard('customer')->user()->monthly_package_status == 'inactive')
                      <button data-activation-status="active" class="btn btn-success open-modal">Activate</button>
                    @else
                      <button data-activation-status="inactive" class="btn btn-danger open-modal">Inactive</button>
                    @endif
                  </center>

            </div>
          </div>
          @endif
        </div>
      </div>
      <!--/ Pricing Plans -->
    </div>



  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Activate monthly package</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="modal-package-name">Are you sure you want to choose this plan?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form id="deleteForm" method="POST" action="{{ route('customer.activeMonthlyPackage.store') }}">
            @csrf
            <input type="hidden" name="status" id="status" value="">
            <button type="submit" class="btn btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection


