<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">UJI SWAB COVID-19</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex row">
            <div class="info col-12">
                <div class="row">
                    <div class="col-8">
                        <a href="javascript::void();" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                    <div class="col-4">
                        <a class="badge badge-danger text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($mainMenu as $menu)
                    @php $isActive = in_array(Request::segment($menu['segment_active']), $menu['active_in']); @endphp
                    <li class="nav-item has-treeview">
                        <a href="{{ $menu['url'] }}" class="nav-link {{ ($isActive) ? 'active' : '' }}">
                            <i class="nav-icon {{ $menu['icon'] }}"></i>
                            <p>
                                {{ $menu['label'] }}
                                @if ($menu['has_submenu'])
                                    <i class="right fas fa-angle-left"></i>
                                @endif
                            </p>
                        </a>
                        @if ($menu['has_submenu'])
                            <ul class="nav nav-treeview">
                                @foreach($subMenu as $sub)
                                    @php $isActive = in_array(Request::segment($sub['segment_active']), $sub['active_in']); @endphp
                                    @if ($menu['name'] == $sub['parent'])
                                        <li class="nav-item {{ ($isActive) ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ $sub['url'] }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ $sub['label'] }}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>