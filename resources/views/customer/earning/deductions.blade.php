@extends('layouts/layoutMaster')

@section('title', 'Deductions')
@section('page-style')
  @vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
  'resources/assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.scss',
  ]);
  <style>
    /* Ensure the container is displayed as a flexbox */
    .lf-wrapper {
      display: flex;
      justify-content: space-between; /* Distribute space between items */
      align-items: center; /* Align items vertically */
    }

    /* Optional: Style length changing input */
    .lf-wrapper .dataTables_length {
      margin-right: auto; /* Push the length changing input to the left */
    }

    /* Optional: Style filtering input */
    .lf-wrapper .dataTables_filter {
      margin-left: auto; /* Push the filtering input to the right */
    }

    /* Additional styling if needed */
    .dt-buttons button{
      margin-right: 5px;
    }


  </style>
@endsection
@section('content')
  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Deductions</h3>
          </div>
          <div class="card-body">
            <table id="user-datatable" class="table table-bordered">
              <thead>
              <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Details</th>
                <th>Date</th>
              </tr>
              </thead>
              <!-- Define your table headers here -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('vendor-script')

  @vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  ])
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(function () {
      var table = $('#user-datatable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        searching: true,
        ordering:  true,
        ajax: {
          url: '{{ route('customer.deductions.data') }}',
        },
        columns: [
          { data: null, name: 'serial_number', orderable: false, searchable: false, render: function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }},
          { data: 'amount', name: 'amount' },
          { data: 'description', name: 'description' },
          { data: 'created_at', name: 'created_at' },
        ],
        dom: 'B<"top"<"lf-wrapper"lf>>rt<"bottom"ip><"clear">',
        lengthMenu: [ [10, 25, 50, 100,-1], [10, 25, 50, 100,'all']], // Page length options
        pageLength: 10, // Default page length
        buttons: [

        ],
        // Default page length
      });

      $('#search').on('click', function() {
        console.log('Working');
        table.draw();
      });
    });


    function confirmDelete(customerId) {
      var form = document.getElementById('deleteForm');
      form.action = '/customers/' + customerId;
      $('#deleteModal').modal('show');
    }
  </script>
@stop
