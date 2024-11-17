@extends('layouts/layoutMaster')

@section('title', 'Site Settings')
@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Mail Settings</h4>
            <div>
                <a href="{{ route('mail_settings.mail_setting.create') }}" class="btn btn-secondary" title="Create New Mail Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($mailSettings) == 0)
            <div class="card-body text-center">
                <h4>No Mail Settings Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Email From Name</th>
                            <th>Email From Address</th>
                            <th>Mailing Driver</th>
                            <th>Mail User Name</th>
                            <th>Mail Password</th>
                            <th>Smpt Host</th>
                            <th>Smpt Port</th>
                            <th>Smtp Secure</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($mailSettings as $mailSetting)
                        <tr>
                            <td class="align-middle">{{ $mailSetting->email_from_name }}</td>
                            <td class="align-middle">{{ $mailSetting->email_from_address }}</td>
                            <td class="align-middle">{{ $mailSetting->mailing_driver }}</td>
                            <td class="align-middle">{{ $mailSetting->mail_user_name }}</td>
                            <td class="align-middle">{{ $mailSetting->mail_password }}</td>
                            <td class="align-middle">{{ $mailSetting->smpt_host }}</td>
                            <td class="align-middle">{{ $mailSetting->smpt_port }}</td>
                            <td class="align-middle">{{ $mailSetting->smtp_secure }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('mail_settings.mail_setting.destroy', $mailSetting->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('mail_settings.mail_setting.show', $mailSetting->id ) }}" class="btn btn-info" title="Show Mail Setting">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('mail_settings.mail_setting.edit', $mailSetting->id ) }}" class="btn btn-primary" title="Edit Mail Setting">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Mail Setting" onclick="return confirm(&quot;Click Ok to delete Mail Setting.&quot;)">
                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $mailSettings->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection