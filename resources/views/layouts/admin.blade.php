<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistema de Tutorías') - {{ config('app.name', 'AndiBonita') }}</title>

    {{-- Bootstrap 5.3.3 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-brand img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }

        .sidebar-brand h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu-item {
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: white;
        }

        .sidebar-menu-item.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left-color: #fbbf24;
            font-weight: 600;
        }

        .sidebar-menu-item i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 0;
        }

        /* Top Navbar */
        .top-navbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        /* Content Area */
        .content-area {
            padding: 2rem;
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        }

        /* Tables */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        /* Badges */
        .badge {
            padding: 0.35rem 0.75rem;
            font-weight: 500;
            border-radius: 4px;
        }

        /* Forms */
        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #d1d5db;
            padding: 0.625rem 0.875rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }

        /* Alert Messages */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .alert-dismissible .btn-close {
            padding: 1.25rem 1rem;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .page-subtitle {
            color: #6b7280;
            margin-top: 0.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .top-navbar {
                padding: 1rem;
            }

            .content-area {
                padding: 1rem;
            }
        }

        /* Loading Spinner */
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner-overlay.show {
            display: flex;
        }
    </style>

    @stack('styles')
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logoi.png') }}" alt="Logo" onerror="this.style.display='none'">
            <div>
                <h4>AndiBonita</h4>
                <small style="font-size: 0.75rem; opacity: 0.8;">Sistema de Tutorías</small>
            </div>
        </div>

        <nav class="sidebar-menu">
            <a href="{{ route('home') }}" class="sidebar-menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Inicio</span>
            </a>

            <a href="{{ route('reac.index') }}" class="sidebar-menu-item {{ request()->routeIs('reac.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Reportes REAC</span>
            </a>

            <a href="{{ route('calendario.form') }}" class="sidebar-menu-item {{ request()->routeIs('calendario.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i>
                <span>Calendario</span>
            </a>

            <a href="{{ route('tutores.index') }}" class="sidebar-menu-item {{ request()->routeIs('tutores.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                <span>Tutores</span>
            </a>

            <a href="{{ route('tutorados.index') }}" class="sidebar-menu-item {{ request()->routeIs('tutorados.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Tutorados</span>
            </a>

            <a href="{{ route('usuarios.index') }}" class="sidebar-menu-item {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i>
                <span>Usuarios</span>
            </a>

            <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                <a href="#" class="sidebar-menu-item">
                    <i class="bi bi-gear"></i>
                    <span>Configuración</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="sidebar-menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </nav>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        {{-- Top Navbar --}}
        <div class="top-navbar">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @yield('breadcrumbs')
                    </ol>
                </nav>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-link text-secondary d-md-none" type="button" onclick="toggleSidebar()">
                    <i class="bi bi-list" style="font-size: 1.5rem;"></i>
                </button>

                <div class="dropdown">
                    <button class="btn btn-link text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="content-area">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <strong>Errores de validación:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Page Content --}}
            @yield('content')
        </div>
    </div>

    {{-- Loading Spinner --}}
    <div class="spinner-overlay" id="loadingSpinner">
        <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>

    {{-- Bootstrap 5.3.3 JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- Custom Scripts --}}
    <script>
        // Toggle Sidebar on Mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }

        // Show Loading Spinner
        function showLoading() {
            document.getElementById('loadingSpinner').classList.add('show');
        }

        // Hide Loading Spinner
        function hideLoading() {
            document.getElementById('loadingSpinner').classList.remove('show');
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

        // Confirm before delete
        function confirmDelete(form) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.')) {
                form.submit();
            }
            return false;
        }
    </script>

    @stack('scripts')
</body>
</html>
