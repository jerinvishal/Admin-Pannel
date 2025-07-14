<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar-toggler {
            border: none;
            font-size: 1.25rem;
        }

        .offcanvas {
            width: 260px;
            background-color: #f8f9fa;
        }

        .offcanvas-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        .offcanvas-body {
            overflow-y: auto;
            padding: 0;
        }

        .nav-link {
            font-size: 1rem;
            color: #343a40;
        }

        .nav-link:hover,
        .dropdown-item:hover {
            background-color: #e9ecef;
            color: #0d6efd;
        }

        .dropdown-menu {
            background-color: #f8f9fa;
            border: none;
            margin: 0;
        }

        .dropdown-item {
            font-size: 0.95rem;
            padding-left: 2.5rem !important;
            color: #495057;
        }

        .dropdown-toggle::after {
            float: right;
            margin-top: 0.5rem;
        }

        .dropdown-menu.show {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-custom sticky-top py-2">
        <div class="container-fluid px-3">
            <!-- Sidebar Toggle Button -->
            <button class="sidebar-toggler btn shadow-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar">
                <i class="bi bi-list"></i>
            </button>

            <!-- User Dropdown -->
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li>
                            <form method="POST" action="{{ route('logout.perform') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar (Offcanvas) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="nav flex-column">
                <a class="nav-link px-4 py-3 border-bottom d-flex align-items-center"
                    href="{{ route('profile.showProfile') }}">
                    <i class="bi bi-person-circle me-2"></i> Profile
                </a>
                
                <div class="nav-item dropdown">
                    <a class="nav-link px-4 py-3 border-bottom dropdown-toggle d-flex align-items-center"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people me-2"></i> Permission
                    </a>
                    <ul class="dropdown-menu w-100 mt-0 border-top-0">
                        <li>
                            @can('permission.create')
                            <a class="dropdown-item px-4 py-2" href="{{ route('permissions.create') }}">
                                <i class="bi bi-plus-circle me-2"></i> Create Permissions
                            </a>
                            @endcan
                        </li>
                        @can('permission.index')
                        <li>
                            <a class="dropdown-item px-4 py-2" href="{{ route('permissions.store') }}">
                                <i class="bi bi-list-ul me-2"></i> View Permissions
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>

                <!-- Users Dropdown Section -->
                <div class="nav-item dropdown">
                    <a class="nav-link px-4 py-3 border-bottom dropdown-toggle d-flex align-items-center"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                    <ul class="dropdown-menu w-100 mt-0 border-top-0">
                        <li>
                            @can('user.create')
                            <a class="dropdown-item px-4 py-2" href="{{ route('profile.create') }}">
                                <i class="bi bi-plus-circle me-2"></i> Create Users
                            </a>
                            @endcan
                        </li>
                        @can('user.view')
                        <li>
                            <a class="dropdown-item px-4 py-2" href="{{ route('profile.index') }}">
                                <i class="bi bi-list-ul me-2"></i> View Users
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>

                <!-- Role Dropdown -->
                <div class="nav-item dropdown">
                    <a class="nav-link px-4 py-3 border-bottom dropdown-toggle d-flex align-items-center"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-shield-lock me-2"></i> Role
                    </a>
                    <ul class="dropdown-menu w-100 mt-0 border-top-0">
                        <li>
                            @can('role.create')
                            <a class="dropdown-item px-4 py-2" href="{{ route('role.create') }}">
                                <i class="bi bi-plus-circle me-2"></i> Create Role
                            </a>
                            @endcan
                        </li>
                        <li>
                            @can('role.view')
                            <a class="dropdown-item px-4 py-2" href="{{ route('role.index') }}">
                                <i class="bi bi-list-ul me-2"></i> View Role
                            </a>
                            @endcan
                        </li>
                    </ul>
                </div>

                <!-- Static Links -->
                @can('user.report')
                <a class="nav-link px-4 py-3 border-bottom d-flex align-items-center" href="#">
                    <i class="bi bi-file-earmark-text me-2"></i> Reports
                </a>
                @endcan

            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>