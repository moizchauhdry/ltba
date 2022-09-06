<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link text-center">
        <img src="{{asset('public/images/logo.png')}}" alt="" class="w-50" style="margin-right: 25px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- {{ dd(Auth::guard('admin')->user()->image_url) }}; --}}
                @if(Auth::guard('admin')->user()->image_url != null)
                    <img src="{{ asset('storage/app/public/'.Auth::guard('admin')->user()->image_url) }}" class="img-circle elevation-2">
                @else
                    <img src="{{asset('public/portal/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('admin.profile') }}" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                        class="nav-link {{(Route::currentRouteName() == 'admin.dashboard') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (Auth::guard('admin')->user()->hasPermission('manage_operators'))
                <li
                    class="nav-item has-treeview {{(Route::currentRouteName() == 'admins.create' || Route::currentRouteName() == 'admins.index'|| Route::currentRouteName() == 'admins.edit' ) ? 'menu-open' : ''}}">
                    <a href="#"
                        class="nav-link {{(Route::currentRouteName() == 'admins.create' || Route::currentRouteName() == 'admins.index' || Route::currentRouteName() == 'admins.edit' ) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Manage Operators
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admins.create')}}"
                                class="nav-link {{(Route::currentRouteName() == 'admins.create') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Admins</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admins.index')}}"
                                class="nav-link {{(Route::currentRouteName() == 'admins.index' || Route::currentRouteName() == 'admins.edit' ) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Admins</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->hasPermission('manage_members'))
                <li
                    class="nav-item has-treeview {{(Route::currentRouteName() == 'members.create' || Route::currentRouteName() == 'members.index'|| Route::currentRouteName() == 'members.edit' ) ? 'menu-open' : ''}}">
                    <a href="#"
                        class="nav-link {{(Route::currentRouteName() == 'members.create' || Route::currentRouteName() == 'members.index' || Route::currentRouteName() == 'members.edit' ) ? 'active' : ''}}">
                        <i class="fas fa-users"></i>
                        <p>
                            Manage Members
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('members.create')}}"
                                class="nav-link {{(Route::currentRouteName() == 'members.create') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Member</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('members.index')}}"
                                class="nav-link {{(Route::currentRouteName() == 'members.index' || Route::currentRouteName() == 'members.edit' ) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Members</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->hasPermission('manage_elections'))
                <li
                    class="nav-item has-treeview {{(Route::currentRouteName() == 'elections.create' || Route::currentRouteName() == 'elections.index'|| Route::currentRouteName() == 'elections.edit' ) ? 'menu-open' : ''}}">
                    <a href="#"
                        class="nav-link {{(Route::currentRouteName() == 'elections.create' || Route::currentRouteName() == 'elections.index' || Route::currentRouteName() == 'elections.edit' ) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-person-booth"></i>
                        <p>
                            Manage Elections
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('elections.create')}}"
                                class="nav-link {{(Route::currentRouteName() == 'elections.create') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Election</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('elections.index')}}"
                                class="nav-link {{(Route::currentRouteName() == 'elections.index' || Route::currentRouteName() == 'elections.edit' ) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Elections</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->hasPermission('manage_seats'))
                <li
                    class="nav-item has-treeview {{(Route::currentRouteName() == 'seats.create' || Route::currentRouteName() == 'seats.index'|| Route::currentRouteName() == 'seats.edit' ) ? 'menu-open' : ''}}">
                    <a href="#"
                        class="nav-link {{(Route::currentRouteName() == 'seats.create' || Route::currentRouteName() == 'seats.index' || Route::currentRouteName() == 'seats.edit' ) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-chair"></i>
                        <p>
                            Manage Seats
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('seats.create')}}"
                                class="nav-link {{(Route::currentRouteName() == 'seats.create') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Seat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('seats.index')}}"
                                class="nav-link {{(Route::currentRouteName() == 'seats.index' || Route::currentRouteName() == 'seats.edit' ) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Seats</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->hasPermission('manage_inquires'))
                <li class="nav-item">
                    <a href="{{route('inquires.index')}}"
                        class="nav-link {{(Route::currentRouteName() == 'inquires.index' || Route::currentRouteName() == 'inquires.edit') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Inquiries
                        </p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
