<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="#" class="app-brand-link">

        <img src="{{ asset('dashboard/icon/Group.svg') }}" height="45" alt="Logo" class="mr-1">


        {{--      <span class="app-brand-text demo  menu-text fw-bold">Effect</span>--}}
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Main Section -->
        <li class="menu-header">@lang('general.Main')</li>
        <li class="menu-item  {{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link side-sclaex">
                <i class="menu-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M13.45 11.55l2.05 -2.05" />
                        <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                    </svg>
                </i>
                <div>@lang('general.Dashboard')</div>
            </a>
        </li>

        <!-- Management Section -->
        @if (Auth::guard('admin')->check())
        <li class="menu-header">@lang('general.Management')</li>
        <li class="menu-item {{ Route::is('admin.admins.*') ? 'active' : '' }}">
            <a href="{{ route('admin.admins.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-user-shield"></i>
                <div>{{__('general.Admins')}}</div>
            </a>
        </li>

        <!-- General Section -->
        <li class="menu-header">@lang('general.General')</li>
        <li class="menu-item {{ Route::is('admin.schools.*') ? 'active' : '' }}">
            <a href="{{ route('admin.schools.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div>{{__('general.schools')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin.suppliers.*') ? 'active' : '' }}">
            <a href="{{ route('admin.suppliers.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div>{{__('general.Suppliers')}}</div>
            </a>
        <li class="menu-item {{ Route::is('admin.cities.*') ? 'active' : '' }}">
            <a href="{{ route('admin.cities.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-map"></i>
                <div>{{__('general.Cities')}}</div>
            </a>
        </li>

        <li class="menu-item {{ Route::is('admin.contact-us.*') ? 'active' : '' }}">
            <a href="{{ route('admin.contact-us.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-message-2"></i>
                <div>{{__('general.contactUs')}}</div>
            </a>
        </li>

        <li class="menu-item {{ Route::is('admin.ads.*') ? 'active' : '' }}">
            <a href="{{ route('admin.ads.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-ad"></i>
                <div>{{__('general.Ads')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin.payment-methods.*') ? 'active' : '' }}">
            <a href="{{ route('admin.payment-methods.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-credit-card"></i>
                <div>{{__('general.Payment Methods')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin.coupons.*') ? 'active' : '' }}">
            <a href="{{ route('admin.coupons.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-tag"></i>
                <div>{{__('general.Coupons')}}</div>
            </a>
        </li>

        <li class="menu-item {{ Route::is('admin.categories.*') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-category"></i>
                <div>{{__('general.Categories')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin.products.*') ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-package"></i>
                <div>{{__('general.Products')}}</div>
            </a>
        </li>



        <!-- Settings Section -->
        <li class="menu-header">@lang('general.Settings')</li>
        <li class="menu-item {{ Route::is('settings.*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div>{{__('general.General Settings')}}</div>
            </a>
        </li>
        @endif
    </ul>

</aside>
<!-- / Menu -->
