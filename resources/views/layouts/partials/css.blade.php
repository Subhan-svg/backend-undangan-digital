@push('css')
    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Plugin CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">

    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 60px;
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #64748b;
            --success-color: #22c55e;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --sidebar-bg: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            --sidebar-active: rgba(255, 255, 255, 0.15);
            --sidebar-text: #e2e8f0;
            --sidebar-muted: #94a3b8;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--sidebar-text);
            margin: 0;
        }

        .sidebar .nav-link {
            color: var(--sidebar-text);
            padding: 0.8rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            margin: 0.125rem 0.75rem;
            border-radius: 0.5rem;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: var(--sidebar-hover);
            border-left-color: var(--primary-color);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: var(--sidebar-active);
            border-left-color: var(--primary-color);
        }

        .sidebar .nav-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
            color: var(--sidebar-muted);
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover i,
        .sidebar .nav-link.active i {
            color: var(--primary-color);
        }

        .sidebar-heading {
            padding: 1.5rem 1.5rem 0.5rem;
            font-family: 'Poppins', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--sidebar-muted);
            letter-spacing: 0.05em;
        }

        /* Logout button in sidebar */
        .sidebar .nav-link.logout-link {
            color: #f87171;
            margin-top: 2rem;
        }

        .sidebar .nav-link.logout-link:hover {
            background: rgba(239, 68, 68, 0.1);
            border-left-color: #ef4444;
        }

        .sidebar .nav-link.logout-link i {
            color: #f87171;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: calc(var(--header-height) + 1.5rem) 1.5rem 1.5rem;
            background: #f8fafc;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* User Dropdown */
        .user-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--secondary-color);
        }

        .user-dropdown .dropdown-toggle img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-dropdown .dropdown-menu {
            margin-top: 0.5rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
            border-radius: 0.5rem;
        }

        .user-dropdown .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-size: 0.875rem;
        }

        /* Card adjustments */
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Button adjustments */
        .btn {
            font-weight: 500;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .top-navbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .wrapper.sidebar-open .main-content {
                transform: translateX(var(--sidebar-width));
            }
        }

        /* Animations */
        .animate__animated {
            animation-duration: 0.6s;
        }

        /* Top Navbar Styles */
        .top-navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            height: var(--header-height);
            background: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            z-index: 999;
            transition: all 0.3s ease;
        }

        .btn-toggle-sidebar {
            background: transparent;
            border: none;
            color: var(--secondary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .btn-toggle-sidebar:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        /* Dropdown Styles */
        .notification-dropdown {
            width: 300px;
            padding: 0;
        }

        .notification-dropdown .dropdown-header {
            background-color: var(--primary-color);
            color: #fff;
            padding: 0.75rem 1rem;
        }

        .nav-link {
            color: var(--secondary-color);
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: rgba(0, 0, 0, 0.05);
            color: var(--primary-color);
        }

        .dropdown-menu {
            margin-top: 0.5rem !important;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
            border-radius: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .top-navbar {
                left: 0;
            }

            body.sidebar-open .top-navbar {
                left: var(--sidebar-width);
            }
        }

        @media (max-width: 767.98px) {
            .top-navbar {
                padding: 0 0.5rem;
            }

            .nav-link img.rounded-circle {
                width: 32px;
                height: 32px;
            }
        }

        /* User Avatar */
        .nav-link img.rounded-circle {
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Custom Checkbox Styling */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0.75rem 0;
        }

        .checkbox-wrapper input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkbox-wrapper label {
            position: relative;
            cursor: pointer;
            padding-left: 28px;
            user-select: none;
            font-weight: 500;
            margin: 0;
            color: #4b5563;
        }

        .checkbox-wrapper label:before {
            content: '';
            position: absolute;
            left: 0;
            top: 1px;
            width: 20px;
            height: 20px;
            border: 2px solid #cbd5e1;
            background: #fff;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .checkbox-wrapper label:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 6px;
            width: 8px;
            height: 8px;
            background: var(--primary-color);
            border-radius: 2px;
            transition: all 0.2s ease;
            opacity: 0;
            transform: scale(0);
        }

        .checkbox-wrapper input:checked + label:before {
            border-color: var(--primary-color);
            background: var(--primary-color);
        }

        .checkbox-wrapper input:checked + label:after {
            opacity: 1;
            transform: scale(1);
            background: #fff;
        }

        .checkbox-wrapper input:focus + label:before {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .checkbox-wrapper:hover label:before {
            border-color: var(--primary-color);
        }
    </style>
@endpush