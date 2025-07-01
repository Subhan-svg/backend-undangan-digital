<nav class="top-navbar">
    <div class="d-flex justify-content-between align-items-center w-100 h-100 px-3">
        <!-- Left side -->
        <div class="d-flex align-items-center">
            <button class="btn-toggle-sidebar me-2" type="button">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Right side -->
        <div class="d-flex align-items-center gap-3">

            <!-- User Menu -->
            <div class="dropdown">
                <a class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4e73df&color=fff" 
                            alt="User" 
                            class="rounded-circle"
                            width="32" 
                            height="32">
                    <span class="ms-2 d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form id="nav-logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" onclick="event.preventDefault(); confirmLogout('nav-logout-form')">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>