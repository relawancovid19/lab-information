<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">UJI SWAB <strong>COVID-19</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('dist/img/logo.png') }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
            </div>
            <div class="info">
                <a href="javascript::void();" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($mainMenu as $menu)
                    @php $isActive = in_array(Request::segment($menu['segment_active']), $menu['active_in']); @endphp
                    <li class="nav-item has-treeview {{ ($isActive) ? 'menu-open' : '' }}">
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
                                    @php $isActive = in_array(Request::path(), $sub['active_in']) || (!empty($sub['not_active']) && !in_array(Request::path(), $sub['not_active'])); @endphp
                                    @if ($menu['name'] == $sub['parent'])
                                        <li class="nav-item">
                                            <a class="nav-link {{ ($isActive) ? 'active' : '' }}" href="{{ $sub['url'] }}">
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