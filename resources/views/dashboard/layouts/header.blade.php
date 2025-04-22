<!-- Navbar -->
<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <span class="d-none d-md-inline-block text-muted fw-normal">
                    <a class="d-block">{{ auth()->user()->name_en }}</a>
                </span>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language Switcher -->
            <li class="nav-item language-switcher">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="nav-link {{ App::getLocale() === $localeCode ? 'active' : '' }}"
                       hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale() == 'ar' ? 'en' : 'ar') }}">
                        {{ strtoupper($localeCode) }}
                    </a>
                @endforeach

            </li>
            <!-- /Language Switcher -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                   data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ auth()->user()->image ? asset(auth()->user()->image) : asset('dashboard/icon/Group.svg') }}"
                             alt class="rounded-circle" />
                    </div>
                </a>
                <ul class="custom-dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item mt-0" href="#">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-2">
                                    <div class="avatar avatar-online">
                                        <img src="{{ auth()->user()->image ? asset(auth()->user()->image) : asset('dashboard/icon/Group.svg') }}"
                                             alt class="rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ auth()->user()->name_en }}</h6>
                                    <small class="text-muted">{{__('general.Admin')}}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1 mx-n2"></div>
                    </li>
                    <li>
                        <div class="d-grid px-2 pt-2 pb-1">
                            <form method="post" action="{{ route('Admin.logout') }}">
                                @csrf
                                <button class="btn btn-sm btn-danger btn-logout d-flex justify-content-center">
                                    <small class="align-middle">{{__('general.Logout')}}</small>
                                    <i class="ti ti-logout ms-2 ti-14px"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>

    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <!-- Additional content here -->
    </div>
</nav>
<!-- / Navbar -->
