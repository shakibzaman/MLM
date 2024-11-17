@extends('layouts/layoutMaster')

@section('title', 'Plugin Settings')
@section('vendor-script')
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
        // $(document).ready(function() {

        //     $(document).on('change', 'input.contacted', function() {
        //         var customerid = $(this).data('id');
        //         var isChecked = $(this).prop('checked');
        //         $.ajax({
        //                 url: '{{ url("update/customer/contact") }}',
        //                 method: 'POST',
        //                 data: { _token: "{{ @csrf_token() }}", contact: (isChecked?1:0), customerid: customerid },
        //                 success: function(data) {
        //                     Swal.fire({
        //                         title: 'Success!',
        //                         text: 'Customer contact status has been updated.',
        //                         icon: 'success',
        //                         confirmButtonText: 'OK'
        //                     });
        //                     console.log(data);
        //                 },
        //                 error: function(xhr, status, error) {
        //             // Handle errors if needed
        //             console.error('Error:', error);
        //         }
        //             });
        //     });
        // })
</script>
@endsection

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {!! session('success_message') !!}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card-header d-flex justify-content-between align-items-center p-3">
    <h2 class="m-0 text-bold">{{ !empty($title) ? $title : 'Plugin Settings' }}</h2>
</div>
<div class="card mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <a class="btn" href="{{ route('site_settings-global_settings-index') }}"><i class="fa fa-cogs"></i> Site
                    Settings</a>
            </div>

            <div class="col-md-2">
                <a class="btn" href="{{ route('mail_settings.mail_setting.index') }}"><i
                        class="fas fa-envelope-open"></i> Email Settings</a>
            </div>
            <div class="col-md-2">
                <a class="btn-info btn" href="{{ route('plugin_settings.plugin_setting.index') }}"><i
                        class="fas fa-briefcase"></i> Plugin Settings</a>

            </div>
            <div class="col-md-2">
                <a class=" btn"><i class="fas fa-comment"></i> SMS Settings</a>

            </div>
            <div class="col-md-2">
                <a class=" btn" href="{{ route('notification_settings') }}"><i class="fas fa-bell"></i> Notification
                    Settings</a>

            </div>

        </div>
    </div>
</div>
<div class="card text-bg-theme">

    <div class="card-header p-3">
        <h4 class="m-0">Third Party System Plugins</h4>
        <small>You can Enable or Disable any of the plugin</small>

    </div>

    @if(count($pluginSettings) == 0)
    <div class="card-body text-center">
        <h4>No Plugin Settings Available.</h4>
    </div>
    @else
    <div class="card-body p-0">
        @foreach($pluginSettings as $pluginSetting)
        <div class="container">
            <div class="row border p-2 mb-2">
                <div class="col-md-1">
                    <div class="name text-center">
                        <p>
                            <i class="fas fa-2x fa-bell"></i>
                        </p>

                    </div>

                </div>
                <div class="col-md-9">
                    <div class="name">
                        <h6>
                            {{ $pluginSetting->name }}
                        </h6>
                        <p>{{ $pluginSetting->description }}</p>

                    </div>

                </div>
                <div class="col-md-1">
                    <span class="badge {{ $pluginSetting->status == 1 ? 'bg-primary' :'bg-warning' }}">
                        {{ $pluginSetting->status == 1 ? 'Active' :'Inactive' }}
                    </span>
                </div>
                <div class="col-md-1">
                    <button>
                        <a data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                            data-attr="{{ route('plugin_settings.plugin_setting.edit',$pluginSetting->id) }}"
                            title="View Review"> <i class="fas fa-2x fa-sliders-h"></i>
                        </a>

                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @endif
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection