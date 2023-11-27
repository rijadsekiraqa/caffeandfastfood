<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
    <!-- Brand Logo -->
    <a href="" class="brand-link bg-gradient-navy text-sm">
        <img src="uploads/logo.png" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 1.5rem;height: 1.5rem;max-height: unset">
        <span class="brand-text font-weight-light">CSCS - PHP</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="clearfix"></div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-4">
                        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item dropdown">
                                <a href="{{route('admin-dashboard')}}" class="nav-link nav-home">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            @role('admin')
                            <li class="nav-item dropdown">
                                <a href="{{route('products.index')}}" class="nav-link nav-products">
                                    <i class="nav-icon fas fa-mug-hot"></i>
                                    <p>
                                        Lista e Produkteve
                                    </p>
                                </a>
                            </li>



                            <li class="nav-item dropdown">
                                <a href="{{route('sales.index')}}" class="nav-link nav-sales">
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>
                                        Shitjet
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="{{route('sales-report')}}" class="nav-link nav-reports">
                                    <i class="nav-icon fas fa-calendar-day"></i>
                                    <p>
                                        Raporti Ditor i Shitjeve
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="{{route('categories.index')}}" class="nav-link nav-categories">
                                    <i class="nav-icon fas fa-th-list"></i>
                                    <p>
                                        Kategorite
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="{{route('users.index')}}" class="nav-link nav-user">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Lista e Perdoruesve
                                    </p>
                                </a>
                            </li>
                            @endrole

                            <li class="nav-item dropdown">
                                <a href="{{route('sales.create')}}" class="nav-link nav-sales_manage_sale">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>
                                        Create Sale
                                    </p>
                                </a>
                            </li>
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a href="#" class="nav-link nav-system_info">--}}
{{--                                    <i class="nav-icon fas fa-tools"></i>--}}
{{--                                    <p>--}}
{{--                                        Settings--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>

