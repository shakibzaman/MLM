@extends('layouts/layoutMaster')

@section('title', 'Fund Transfer')
<!-- Vendor Styles -->

@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
'resources/assets/vendor/libs/select2/select2.scss'
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js',
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js'
])
<script>
    $(document).on('click', '#mediumButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#mediumModal').modal("show");
                $('#mediumBody').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });
</script>
@endsection
@section('content')

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {!! session('error') !!}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ $type }} Point Wallet</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- About User -->
        @if($point_convert_list->count()>0)

        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Point</th>
                        <th>Dollar</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $statusLabels = array_flip(config('app.statuses'));
                    @endphp
                    @foreach($point_convert_list as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>{{ $list->customer->name }}</td>
                        <td>
                            <span
                                class="{{ $list->status==1 ? 'bg-info' : ($list->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                                {{ strtoupper($statusLabels[$list->status] ?? 'N/A') }}
                            </span>
                        </td>
                        <td>{{ $list->point }}</td>
                        <td>{{ $list->doller }}</td>
                        <td>{{ $list->created_at }}</td>
                        <td>
                            <a class="btn-primary p-2 rounded text-white cursor-pointer" id="mediumButton"
                                data-bs-toggle="modal" data-bs-target="#mediumModal"
                                data-attr="{{ route('pointWallet_show',$list->id) }}" title="View Review">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- Content will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection