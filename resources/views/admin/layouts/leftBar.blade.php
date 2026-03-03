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
                @if (auth('admin')->check())
                    <li class="{{ request()->routeIs('users.*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="mdi mdi-account-multiple-outline"></i>
                            <span>Users</span>
                        </a>
                    </li>
                @endif
                @if (auth('admin')->check())
                    <li class="{{ request()->routeIs('vibes.*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('vibes.index') }}"
                            class="{{ request()->routeIs('vibes.*') ? 'active' : '' }}">
                            <i class="mdi mdi-emoticon-outline"></i>
                            <span>Vibes</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
