@extends('layouts/layoutMaster')

@section('title', 'Site Settings')

@section('content')

<div class="text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h2 class="m-0 text-bold">{{ !empty($title) ? $title : 'Site Setting' }}</h2>
    </div>
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <a class="btn" href="{{ route('site_settings-global_settings-index') }}"><i class="fa fa-cogs"></i>
                        Site
                        Settings</a>
                </div>

                <div class="col-md-2">
                    <a class="btn btn-info " href="{{ route('mail_settings.mail_setting.index') }}"><i
                            class="fas fa-envelope-open"></i> Email Settings</a>
                </div>
                <div class="col-md-2">
                    <a class="btn" href="{{ route('plugin_settings.plugin_setting.index') }}"><i
                            class="fas fa-briefcase"></i> Plugin Settings</a>

                </div>
                <div class="col-md-2">
                    <a class=" btn"><i class="fas fa-comment"></i> SMS Settings</a>

                </div>
                <div class="col-md-2">
                    <a class="btn" href="{{ route('notification_settings') }}"><i class="fas fa-bell"></i>
                        Notification
                        Settings</a>

                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-bold">Mail Settings</h5>
                        </div>
                        <div class="col-md-6 ">
                            <a class="btn btn-info float-right" data-bs-toggle="modal" id="mediumButton"
                                data-target="#mediumModal"
                                data-attr="{{ route('mail_settings.mail_setting.mail_check') }}">
                                <i class="fas fa-envelope-open"></i> Connection
                                Check
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="list-unstyled mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" class="needs-validation" novalidate
                        action="{{ route('mail_settings.mail_setting.update', $mailSetting->id) }}"
                        id="edit_mail_setting_form" name="edit_mail_setting_form" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        @include ('mail_settings.form', [
                        'mailSetting' => $mailSetting,
                        ])

                        <div class="col-lg-8 col-xl-8 offset-lg-4 offset-xl-4">
                            <input class="p-2 rounded btn-info" type="submit" value="Update" style="width:100%">
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body" id="mediumBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">X</button>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('js')
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
@stop