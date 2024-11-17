@extends('layouts/layoutMaster')

@section('title',  __('downline'))
@section('page-style')
  <!-- Page -->
  @vite([
  'resources/assets/vendor/libs/select2/select2.scss',
  ])
  <style>
    /*.toggle-icon {*/
    /*  cursor: pointer; !* Change cursor to pointer for better UX *!*/
    /*  margin-right: 5px; !* Spacing between icon and name *!*/
    /*  display: inline-block; !* Ensure proper alignment *!*/
    /*}*/

    /*.collapse {*/
    /*  padding-left: 20px; !* Indentation for nested lists *!*/
    /*}*/

  </style>
@endsection

@section('content')
  <div class="raw">
    <div class="col-md-12">
      <div class="card min-vh-100">
        <h5 class="card-header">{{ __('downline') }}</h5>
        <hr class="m-0" />
        <div class="card-body">
          <ul>
            <li class="list-unstyled">
              <a href="#" class='targaryen text-reset text-decoration-none'>{{ auth()->guard('customer')->user()? auth()->guard('customer')->user()->name : 'Admin' }}</a>
              @php
                $displayedUsers = collect(); // Initialize an empty collection to track displayed users
              @endphp

              <ul>
                @foreach ($customers as $customer)
                  @include('_partials.referral_item', ['user' => $customer, 'displayedUsers' => $displayedUsers])
                @endforeach
              </ul>
            </li>
          </ul>
        </div>
        <hr class="m-0" />
      </div>
    </div>
  </div>
@endsection
@section('vendor-script')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.collapse').on('show.bs.collapse', function() {
        $(this).prev('.toggle-icon').find('i').removeClass('bi-plus-circle').addClass('bi-minus-circle');
      });

      $('.collapse').on('hide.bs.collapse', function() {
        $(this).prev('.toggle-icon').find('i').removeClass('bi-minus-circle').addClass('bi-plus-circle');
      });
    });
  </script>
@endsection

