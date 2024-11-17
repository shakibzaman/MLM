@php
use Illuminate\Support\Facades\Route;
$configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <!-- Hide app brand if navbar-full -->
  @if(!isset($navbarFull))
  <div class="app-brand demo">
    @if (Auth::guard('customer')->check())
    <a href="{{ url('/user/dashboard') }}" class="app-brand-link">
      @if(isset($globalSetting))
      <span><img src="{{ asset('storage/' . $globalSetting->site_logo) }}" alt="" class="admin-logo"
          style="width: 80%"></span>
      @endif
    </a>

    @else
    <a href="{{ url('/dashboard') }}" class="app-brand-link">
      @if(isset($globalSetting))
      <span><img src="{{ asset('storage/' . $globalSetting->site_logo) }}" alt="" class="admin-logo"
          style="width: 80%"></span>
      @endif
    </a>
    @endif

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>
  @endif

  <div class="menu-inner-shadow"></div>
  @if(auth()->guard('customer')->user())
    <div class="user-info d-flex p-6 pb-1">
      <img class="img img-thumbnail pt-2" style="width: 60px; height: fit-content;" src="{{ asset('storage') }}/{{ auth()->guard('customer')->user()->country->flag }}" />
      <div class="member-since p-2">
        <p class="m-0">Member since</p>
        <p class="m-0">{{ auth()->guard('customer')->user()->created_at->format('d F Y') }}</p>
      </div>
    </div>
  @endif

  <div class="menu-inner py-1">
  <ul class="">
    @foreach ($menuData[0]->menu as $menu)
    {{-- Menu headers --}}
    @if (isset($menu->menuHeader))
    <li class="menu-header small">
      <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
    </li>
    @else
    {{-- Check permission for main menu --}}
    @if (!isset($menu->can) || (auth()->check() && auth()->user()->can($menu->can)))
    @php
    $activeClass = null;
    $currentRouteName = Route::currentRouteName();

    if ($currentRouteName === $menu->slug) {
    $activeClass = 'active';
    } elseif (isset($menu->submenu)) {
    if (is_array($menu->slug)) {
    foreach ($menu->slug as $slug) {
    if (str_contains($currentRouteName, $slug) && strpos($currentRouteName, $slug) === 0) {
    $activeClass = 'active open';
    }
    }
    } else {
    if (str_contains($currentRouteName, $menu->slug) && strpos($currentRouteName, $menu->slug) === 0) {
    $activeClass = 'active open';
    }
    }
    }
    @endphp

    {{-- Main menu item --}}
    <li class="menu-item {{ $activeClass }}">
      <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
        class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}">
        @isset($menu->icon)
        <i class="{{ $menu->icon }}"></i>
        @endisset
        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
        @isset($menu->badge)
        <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
        @endisset
      </a>

      {{-- Submenu --}}
      @isset($menu->submenu)
      <ul class="menu-sub">
        @foreach ($menu->submenu as $submenu)
        {{-- Check permission for submenu --}}
        @if (!isset($submenu->can) || (auth()->check() && auth()->user()->can($submenu->can)))
        <li class="menu-item">
          <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0);' }}" class="menu-link">
            @if (isset($submenu->target) && !empty($submenu->target))
            target="_blank"
            @endif
            @isset($submenu->icon)
            <i class="{{ $submenu->icon }}"></i>
            @endisset
            <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
          </a>
        </li>
        @endif
        @endforeach
      </ul>
      @endisset
    </li>
    @endif
    @endif
    @endforeach
  </ul>
    @if(auth()->guard('customer')->user())
      <div class="download-book p-6 text-center">
        <p>{{ __('Unlock the Secret to Earning $1,500 a Month!') }}</p>
        <img class="img img-thumbnail img-fluid" src="{{ asset('assets/img/dashboard/istockphoto.jpg') }}" alt="book" />

        <a class="btn btn-secondary rounded-pill" href="{{ route('customer.book.download') }}">Download</a>
      </div>
      @endif
  </div>
</aside>
