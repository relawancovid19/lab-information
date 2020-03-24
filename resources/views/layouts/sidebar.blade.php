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
                    @php $menuIsActive = in_array(Request::segment($menu['segment_active']), $menu['active_in']); @endphp
                    <li class="nav-item has-treeview">
                        <a href="{{ $menu['url'] }}" class="nav-link {{ ($menuIsActive) ? 'active' : '' }}">
                            <i class="nav-icon {{ $menu['icon'] }}"></i>
                            <p>
                                {{ $menu['label'] }}
                                @if ($menu['submenu'])
                                    <i class="right fas fa-angle-left"></i>
                                @endif
                            </p>
                        </a>
                        @if ($menu['submenu'])
                            <ul class="nav nav-treeview" {{ ($menuIsActive) ? 'style=display:block' : "" }}>
                                @foreach($menu['submenu'] as $sub)
                                    @php $subIsActive = in_array(Request::segment($sub['segment_active']), $sub['active_in']); @endphp
                                    @if ($menu['name'] == $sub['parent'])
                                        <li class="nav-item">
                                            <a class="nav-link {{ ($menuIsActive && $subIsActive) ? 'active' : '' }}" href="{{ $sub['url'] }}">
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
