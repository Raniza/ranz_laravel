<div class="sidebar mt-2">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home.index') }}" class="nav-link">
                    <i class="nav-icon fa-solid fa-house"></i>
                    <p>
                        Home
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                    class="nav-link {{ request()->routeIs('users*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-users"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('tutorials.comment.index') }}"
                    class="nav-link {{ request()->routeIs('tutorials.comment.index') ? 'active' : '' }}">
                    <i class="nav-icon fa-regular fa-comments"></i>
                    <p>
                        Comments
                    </p>
                </a>
            </li>
            {{-- <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Starter Pages
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Active Page</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inactive Page</p>
                        </a>
                    </li>
                </ul>
            </li> --}}

        </ul>
    </nav>
</div>