@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Customer;
$containerNav = ($configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
$user = Auth::user();

if (Auth::guard('customer')->check()){
$customerId = Auth::guard('customer')->user()->id;
$customer = Customer::find($customerId);
// Retrieve all notifications for the customer
$notifications = $customer->notifications;
// Retrieve all notifications for the customer
$notifications = $customer->notifications()->latest()->take(5)->get();
}else{
$userId = Auth::user()->id;
$user = User::find($userId);
// Retrieve all notifications for the customer
$notifications = $user->notifications()->latest()->take(5)->get();
}



@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav
  class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme"
  id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link">
          <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20])</span>
          <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>
        @if(isset($menuHorizontal))
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
          <i class="ti ti-x ti-md align-middle"></i>
        </a>
        @endif
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="ti ti-menu-2 ti-md"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        @if(!isset($menuHorizontal))
        @can('customer-menu')
        <a href="/user/dashboard" class="mt-2"><i class="fas fa-globe"></i></a>
        @endcan
        @can('admin-menu')
        <a href="/dashboard" class="mt-2"><i class="fas fa-globe"></i></a>
        @endcan
        @endif

        <ul class="navbar-nav flex-row align-items-center ms-auto">
          @if(isset($menuHorizontal))
          <!-- Search -->
          <li class="nav-item navbar-search-wrapper">
            <a class="nav-link btn btn-text-secondary btn-icon rounded-pill search-toggler" href="javascript:void(0);">
              <i class="ti ti-search ti-md"></i>
            </a>
          </li>
          <!-- /Search -->
          @endif
          <!-- Language -->
          <li class="nav-item dropdown-language dropdown">
            <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
              href="javascript:void(0);" data-bs-toggle="dropdown">
              {{ strtoupper( config('app.locale')) }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              @foreach($languages as $key=> $lang)
              <li>
                <a class="dropdown-item {{ app()->getLocale() === $lang ? 'active' : '' }}"
                  href="{{url('/set-locale/'.$lang)}}" data-language="{{ $lang }}" data-text-direction="ltr">
                  <span>{{ $lang }}</span>
                </a>
              </li>
              @endforeach
            </ul>
          </li>
          <!--/ Language -->
          @if($configData['hasCustomizer'] == true)
          <!-- Style Switcher -->
          <li class="nav-item dropdown-style-switcher dropdown">
            <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
              href="javascript:void(0);" data-bs-toggle="dropdown">
              <i class='ti ti-md'></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                  <span class="align-middle"><i class='ti ti-sun ti-md me-3'></i>Light</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                  <span class="align-middle"><i class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                  <span class="align-middle"><i class="ti ti-device-desktop-analytics ti-md me-3"></i>System</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- / Style Switcher -->
          @endif
          @can('customer-menu')
          <a href="/chatify" target="_blank" class="mt-2"><i class="fas fa-comments"></i></a>
          @endcan
          <!-- Notification -->
          <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
            <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
              href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <span class="position-relative">
                <i class="ti ti-bell ti-md"></i>
                <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-0">
              <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h6 class="mb-0 me-auto">Notification</h6>
                  <div class="d-flex align-items-center h6 mb-0">
                    <span class="badge bg-label-primary me-2">New</span>

                    <a href="javascript:void(0)"
                      class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all"
                      data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                        class="ti ti-mail-opened text-heading"></i></a>
                  </div>
                </div>
              </li>
              <li class="dropdown-notifications-list scrollable-container">
                <ul class="list-group list-group-flush">
                  @foreach ($notifications as $notification)
                  <li class="list-group-item list-group-item-action dropdown-notifications-item">
                    <a href="{{ $notification->data['link']}}">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          {{-- <div class="avatar">
                            <img src="{{asset('assets/img/avatars/1.png')}}" alt class="rounded-circle">
                          </div> --}}
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="small mb-1">{{ $notification->data['title'] }}</h6>
                          <small class="mb-1 d-block text-body">{{ $notification->data['description'] ?? null}}</small>
                          <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                              class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                              class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="border-top">
                <div class="d-grid p-4">
                  @if (Auth::guard('customer')->check())
                  <a class="btn btn-primary btn-sm d-flex" href="/user/notifications">
                    <small class="align-middle">View all notifications</small>
                  </a>
                  @else
                  <a class="btn btn-primary btn-sm d-flex" href="notifications">
                    <small class="align-middle">View all notifications</small>
                  </a>
                  @endif
                </div>
              </li>
            </ul>
          </li>
          <!--/ Notification -->

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                @if (Auth::guard('customer')->check())
                @if (isset(Auth::user()->image) && !empty(Auth::user()->image))
                <img
                  src="{{ Auth::user() ? asset('storage/' . Auth::user()->image) : asset('assets/img/avatars/1.png') }}"
                  alt class="rounded-circle">
                @else
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image" class="rounded-circle">
                @endif
                @else
                @if (isset(Auth::user()->image) && !empty(Auth::user()->image))
                <img
                  src="{{ Auth::user() ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}"
                  alt class="rounded-circle">

                @else
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image" class="rounded-circle">
                @endif
                @endif

              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item mt-0"
                  href="{{ Route::has('profile.show') ? route('profile.show') : url('pages/profile-user') }}">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                      <div class="avatar avatar-online">
                        @if (Auth::guard('customer')->check())
                        @if (isset(Auth::user()->image) && !empty(Auth::user()->image))
                        <img
                          src="{{ Auth::user() ? asset('storage/' . Auth::user()->image) : asset('assets/img/avatars/1.png') }}"
                          alt class="rounded-circle">
                        @else
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image" class="rounded-circle">
                        @endif
                        @else
                        @if (isset(Auth::user()->image) && !empty(Auth::user()->image))
                        <img
                          src="{{ Auth::user() ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}"
                          alt class="rounded-circle">

                        @else
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image" class="rounded-circle">
                        @endif
                        @endif
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">
                        @if (Auth::check())
                        @if (Auth::guard('customer')->check())
                        {{ Auth::user()->name }}
                        @else
                        {{ Auth::user()->username }}

                        @endif
                        @else
                        John Doe
                        @endif
                      </h6>
                      @if (Auth::guard('customer')->check())
                      <small class="text-muted">Member</small>
                      @else
                      <small class="text-muted">Admin</small>
                      @endif
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1 mx-n2"></div>
              </li>
              <li>
                @if (Auth::guard('customer')->check())
                <a class="dropdown-item"
                  href="{{ Route::has('customer.profile') ? route('customer.profile') : url('user/profile') }}">
                  <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">My Profile</span>
                </a>
                @else
                <a class="dropdown-item"
                  href="{{ Route::has('profile.index') ? route('profile.index') : url('profile') }}">
                  <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">My Profile</span>
                </a>
                @endif

              </li>

              @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
              <li>
                <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                  <i class="ti ti-key ti-md me-3"></i><span class="align-middle">API Tokens</span>
                </a>
              </li>

              <li>
                <a class="dropdown-item" href="{{url('pages/account-settings-billing')}}">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 ti ti-file-dollar me-3 ti-md"></i><span
                      class="flex-grow-1 align-middle">Billing</span>
                    <span
                      class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center">4</span>
                  </span>
                </a>
              </li>
              @endif

              @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
              <li>
                <div class="dropdown-divider my-1 mx-n2"></div>
              </li>
              <li>
                <h6 class="dropdown-header">Manage Team</h6>
              </li>
              <li>
                <div class="dropdown-divider my-1 mx-n2"></div>
              </li>
              <li>
                <a class="dropdown-item"
                  href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
                  <i class="ti ti-settings ti-md me-3"></i><span class="align-middle">Team Settings</span>
                </a>
              </li>
              @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
              <li>
                <a class="dropdown-item" href="{{ route('teams.create') }}">
                  <i class="ti ti-user ti-md me-3"></i><span class="align-middle">Create New Team</span>
                </a>
              </li>
              @endcan

              @if (Auth::user()->allTeams()->count() > 1)
              <li>
                <div class="dropdown-divider my-1 mx-n2"></div>
              </li>
              <li>
                <h6 class="dropdown-header">Switch Teams</h6>
              </li>
              <li>
                <div class="dropdown-divider my-1 mx-n2"></div>
              </li>
              @endif

              @if (Auth::user())
              @foreach (Auth::user()->allTeams() as $team)
              {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you
              want to use jetstream. --}}

              {{--
              <x-switchable-team :team="$team" /> --}}
              @endforeach
              @endif
              @endif
              <li>
                <div class="dropdown-divider my-1 mx-n2"></div>
              </li>
              @if (Auth::check())
              @if (Auth::guard('customer')->check())
              <li>
                <div class="d-grid px-2 pt-2 pb-1">
                  <a class="btn btn-sm btn-danger d-flex" href="{{ route('user.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-customer').submit();">
                    <small class="align-middle">Logout</small>
                    <i class="ti ti-logout ms-2 ti-14px"></i>
                  </a>
                </div>
              </li>
              <form method="POST" id="logout-form-customer" action="{{ route('user.logout') }}">
                @csrf
              </form>
              @elseif (Auth::guard('web')->check())
              <li>
                <div class="d-grid px-2 pt-2 pb-1">
                  <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <small class="align-middle">Logout</small>
                    <i class="ti ti-logout ms-2 ti-14px"></i>
                  </a>
                </div>
              </li>
              <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
              </form>
              @endif
              @else
              <li>
                <div class="d-grid px-2 pt-2 pb-1">
                  <a class="btn btn-sm btn-danger d-flex"
                    href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
                    <small class="align-middle">Login</small>
                    <i class="ti ti-login ms-2 ti-14px"></i>
                  </a>
                </div>
              </li>
              @endif
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>
      @if(isset($navbarDetached) && $navbarDetached == '')
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
  @include('layouts.partials.success-message')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Toastr JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Pusher JavaScript -->
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <style>
    /* Custom style for Toastr notifications */
    .toast-info .toast-message {
      display: flex;
      align-items: center;
    }

    .toast-info .toast-message i {
      margin-right: 10px;
    }

    .toast-info .toast-message .notification-content {
      display: flex;
      flex-direction: row;
      align-items: center;
    }
  </style>
  <script>
    Pusher.logToConsole = true;

    @php
    $userName = null;
    $guard = null;
    $userIs = null;

    if (Auth::guard('user')->check()) {
        $userName = Auth::guard('user')->user()->name;
        $userIs = Auth::guard('user')->user();
        $guard = 'user';
    } elseif (Auth::guard('customer')->check()) {
        $userIs = Auth::guard('customer')->user();
        $userName = Auth::guard('customer')->user()->name;
        $guard = 'customer';
    } elseif (Auth::check()) {
        $userName = Auth::user()->name;
        $userIs = Auth::user();
        $guard = 'default';
    }
@endphp

    var currentUserName = '{{ $userName }}';
    var user = @json($userIs);
    var currentGuard = @json($guard);

    // Initialize Pusher
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
    });

    // Subscribe to the channel
    var channel = pusher.subscribe('notification');

    // Bind to the event
    channel.bind('test.notification', function(data) {
        // Check if the notification is intended for the current user's type
        if (data.author === (currentGuard == 'default' ? user.username : currentUserName)) {
            // Display Toastr notification with icons and inline content
            if (data.author && data.title) {
                toastr.info(
                    `<div class="notification-content">
                        <i class="fas fa-user"></i> <span> ${data.title}</span>
                        <i class="fas fa-book" style="margin-left: 20px;"></i> <span> ${data.description}</span>
                    </div>`,
                    'New Notification',
                    {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 0,
                        extendedTimeOut: 0,
                        positionClass: 'toast-top-right',
                        enableHtml: true
                    }
                );
            } else {
                console.error('Invalid data received:', data);
            }
        } else {
            console.log('Notification skipped for this user type.');
        }
    });

    // Debugging line
    pusher.connection.bind('connected', function() {
        console.log('Pusher connected');
    });
  </script>