<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>

                <!-- Dashboard -->
                <li class="{{ request()->routeIs('dashboard') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Users -->
                @if(auth('admin')->check())
                    <li class="{{ request()->routeIs('users.*') ? 'menuitem-active' : '' }}">
                        <a href="#users" data-bs-toggle="collapse"
                            class="{{ request()->routeIs('users.*') ? '' : 'collapsed' }}">
                            <i class="mdi mdi-account-multiple-outline"></i>
                            <span>Users</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" id="users">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('users.create') }}"
                                        class="{{ request()->routeIs('users.create') ? 'active' : '' }}">
                                        Create
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('users.index') }}"
                                        class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                                        Listing
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
