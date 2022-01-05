<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ url('/') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.index') }}" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-user">User</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('jadwal.index') }}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-jadwal">Jadwal</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.index') }}" class="waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-pendaftar">Pendaftar</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Multi Level</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);" key="t-level-1-1">Level 1.1</a></li>
                    </ul>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
