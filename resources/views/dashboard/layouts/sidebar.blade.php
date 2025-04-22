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
            <a href="{{ route('dashboard') }}" class="menu-link side-sclaex">
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
        <li class="menu-header">@lang('general.Management')</li>
        <li class="menu-item {{ Route::is('admins.*') ? 'active' : '' }}">
            <a href="{{ route('admins.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-user-shield"></i>
                <div>{{__('general.Admins')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('customer.*') ? 'active' : '' }}">
            <a href="{{ route('customer.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div>{{__('general.Contact client')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('member.*') ? 'active' : '' }}">
            <a href="{{ route('member.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div>{{__('general.Members')}}</div>
            </a>
        </li>

        <!-- General Section -->
        <li class="menu-header">@lang('general.General')</li>
        <li class="menu-item {{ Route::is('services.*') ? 'active' : '' }}">
            <a href="{{ route('services.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div>{{__('general.Services')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('company.*') ? 'active' : '' }}">
            <a href="{{ route('company.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-building"></i>
                <div>{{__('general.Companies')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('process.*') ? 'active' : '' }}">
            <a href="{{ route('process.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-clock"></i>
                <div>{{__('general.our process')}}</div>
            </a>
        </li>          
        <li class="menu-item {{ Route::is('client_satisfactions.*') ? 'active' : '' }}">
            <a href="{{ route('client_satisfactions.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-thumb-up"></i>
                <div>{{__('general.Client Satisfactions')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('work.*') ? 'active' : '' }}">
            <a href="{{ route('work.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div>{{__('general.Works')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('blog.*') ? 'active' : '' }}">
            <a href="{{ route('blog.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-notebook"></i>
                <div>{{__('general.Blogs')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('question.*') ? 'active' : '' }}">
            <a href="{{ route('question.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-help-circle"></i>
                <div>{{__('general.Questions')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('term.*') ? 'active' : '' }}">
            <a href="{{ route('term.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-file-text"></i>
                <div>{{__('general.Terms & Conditions')}}</div>
            </a>
        </li>

        <!-- Settings Section -->
        <li class="menu-header">@lang('general.Settings')</li>
        <li class="menu-item {{ Route::is('settings.*') ? 'active' : '' }}">
            <a href="{{ route('settings.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div>{{__('general.General Settings')}}</div>
            </a>
        </li>
    </ul>

</aside>
<!-- / Menu -->
