<nav class="sidebar">
    <div class="sidebar-header">
        {{-- @if(isset($settings['site_logo']))
            <img src="{{ asset($settings['site_logo']) }}" alt="Logo" class="img-fluid mb-2" style="max-height: 50px;">
        @endif --}}
        <h4>Admin Panel</h4>
    </div>
    
    <ul class="nav flex-column">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        <div class="sidebar-heading">Transaction</div>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-money-bill"></i> Transactions
            </a>
        </li>

        <div class="sidebar-heading">Master</div>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-newspaper"></i> Products
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-folder"></i> Categories
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-info-circle"></i> About Us
            </a>
        </li>

        <!-- Settings -->
        <div class="sidebar-heading">Settings</div>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-user"></i> My Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-cog"></i> Website Settings
            </a>
        </li>

        <!-- Logout -->
        <li class="nav-item mt-4">
            <form id="sidebar-logout-form" action="#" method="POST" 
                    onsubmit="confirmLogout('sidebar-logout-form'); return false;">
                @csrf
                <button type="submit" class="nav-link logout-link border-0 bg-transparent w-100 text-start">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>