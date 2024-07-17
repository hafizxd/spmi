<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('admin.dashboard') }}">
                {{-- <img class="img-fluid for-light" src="{{ url('/html/assets/images/logo/logo.png') }}" alt=""> --}}
                <h4 style="color: white; margin-top: 10px;">Polines SPMI</h4>
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            {{-- <div class="toggle-sidebar"><i class="fa fa-cog status_toggle middle sidebar-toggle"> </i></div> --}}
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('admin.users.auditors.index') }}"><img class="img-fluid" src="{{ url('/html/assets/images/logo/logo-icon1.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{ route('admin.users.auditors.index') }}"><img class="img-fluid" src="{{ url('/html/assets/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="menu-box">
                        <ul>
                            @if (auth()->user()->role == \App\Constants\UserRole::ADMIN)
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}"><i data-feather="home"> </i><span>Dashboard</span></a>
                                </li>
                                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="box"></i><span>Pengawasan</span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('admin.proses_audits.index') }}">Proses Audit</a></li>
                                    </ul>
                                </li>
                                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="users"></i><span>User</span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('admin.users.unit-jurusan.index') }}">Unit</a></li>
                                        <li><a href="{{ route('admin.users.auditors.index') }}">Auditor</a></li>
                                        <li><a href="{{ route('admin.users.admins.index') }}">Admin</a></li>
                                    </ul>
                                </li>
                                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="book"></i><span>Audit</span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('admin.audits.audits.index') }}">Audit</a></li>
                                        <li><a href="{{ route('admin.audits.standards.index') }}">Standar</a></li>
                                        <li><a href="{{ route('admin.audits.incompatibilities.index') }}">Ketidaksesuaian</a></li>
                                        <li><a href="{{ route('admin.audits.cycles.index') }}">Siklus</a></li>
                                    </ul>
                                </li>
                            @elseif (auth()->user()->role == \App\Constants\UserRole::AUDITOR)
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('auditor.dashboard') }}"><i data-feather="home"> </i><span>Dashboard</span></a>
                                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="book"></i><span>Audit</span></a>
                                        <ul class="sidebar-submenu">
                                            <li><a href="{{ route('auditor.audits.index') }}">Proses</a></li>
                                        </ul>
                                    </li>
                                </li>
                            @elseif (auth()->user()->role == \App\Constants\UserRole::UNIT_JURUSAN || auth()->user()->role == \App\Constants\UserRole::UNIT_PRODI)
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('unit.dashboard') }}"><i data-feather="home"> </i><span>Dashboard</span></a>
                                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="book"></i><span>Audit</span></a>
                                        <ul class="sidebar-submenu">
                                            <li><a href="{{ route('unit.audits.index') }}">Proses</a></li>
                                        </ul>
                                    </li>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
