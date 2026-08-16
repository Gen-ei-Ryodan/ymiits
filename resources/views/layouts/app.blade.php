<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - CMS Laravel</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
    :root {
        --primary: #16a34a;        /* Hijau utama */
        --primary-hover: #15803d;  /* Hijau lebih gelap untuk hover */
        --secondary: #ecfdf5;      /* Hijau sangat terang untuk background */
        --dark: #064e3b;           /* Hijau gelap untuk sidebar */
        --light: #f0fdf4;          /* Hijau sangat terang untuk elemen light */
        --danger: #ef4444;         /* Merah tetap sama */
        --success: #10b981;        /* Hijau untuk success */
        --warning: #f59e0b;        /* Oranye tetap sama */
        --text-dark: #064e3b;      /* Hijau gelap untuk teks utama */
        --text-light: #059669;     /* Hijau agak terang untuk teks sekunder */
        --border: #d1fae5;         /* Border hijau sangat terang */
        --shadow: 0 1px 3px 0 rgba(6, 78, 59, 0.1), 0 1px 2px 0 rgba(6, 78, 59, 0.06);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    body {
        background-color: var(--secondary);
        color: var(--text-dark);
    }

    .container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
    width: 250px;
    background-color: var(--dark);
    color: white;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto; /* scroll jika content melebihi tinggi */
    transition: all 0.3s;
    z-index: 100;
}


    .sidebar-header {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logo {
        font-size: 1.5rem;
        font-weight: 600;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .logo span {
        color: var(--primary);
    }

    .sidebar-menu {
        padding: 1rem 0;
    }

    .menu-category {
        padding: 0.5rem 1rem;
        color: var(--text-light);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        font-weight: 600;
    }

    .menu-item {
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #e5e7eb;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
        position: relative;
    }

    .menu-item:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }

    .menu-item.active {
        background-color: var(--primary);
        font-weight: 500;
        color: white;
    }

    .menu-item.active:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background-color: white;
    }

    .menu-item i {
        width: 20px;
        text-align: center;
    }

    .menu-item-form {
        width: 100%;
    }

    .menu-item-form button {
        background: none;
        border: none;
        width: 100%;
        text-align: left;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 250px;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex: 1;
        padding: 1.5rem;
    }

    /* Top Navigation */
    .top-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 1rem 1.5rem;
        box-shadow: var(--shadow);
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .search-box {
        display: flex;
        align-items: center;
        
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        width: 300px;
    }

    .search-box input {
        background: transparent;
        border: none;
        outline: none;
        padding: 0.25rem;
        margin-left: 0.5rem;
        width: 100%;
        
    }

    .user-menu {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .notification {
        position: relative;
        cursor: pointer;
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: var(--danger);
        color: white;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        position: relative;
    }

    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 0.5rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: var(--shadow);
        width: 200px;
        z-index: 100;
        display: none;
    }

    .user-profile:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        color: var(--text-dark);
        text-decoration: none;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background-color: var(--secondary);
    }

    .dropdown-divider {
        height: 1px;
        background-color: var(--border);
        margin: 0.5rem 0;
    }

    /* Common Card Styling */
    .card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: var(--shadow);
        margin-bottom: 1.5rem;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Footer */
    .admin-footer {
        padding: 1.25rem 1.5rem;
        background-color: white;
        border-top: 1px solid var(--border);
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* Forms */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border);
        border-radius: 0.375rem;
        outline: none;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
    }

    .btn-secondary {
        background-color: var(--secondary);
        color: var(--text-dark);
    }

    .btn-secondary:hover {
        background-color: #e5e7eb;
    }

    .btn-danger {
        background-color: var(--danger);
        color: white;
    }

    .btn-danger:hover {
        background-color: #dc2626;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }

    /* Tables */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        text-align: left;
        padding: 0.75rem 1rem;
        color: var(--text-light);
        font-weight: 500;
        font-size: 0.875rem;
        border-bottom: 1px solid var(--border);
    }

    .table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--border);
    }

    .table tr:last-child td {
        border-bottom: none;
    }

    .text-center {
        text-align: center;
    }

    /* Alerts */
    .alert {
        padding: 1rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
        border-left: 4px solid;
    }

    .alert-success {
        background-color: rgba(16, 185, 129, 0.1);
        border-color: var(--success);
        color: var(--success);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .charts-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 70px;
            overflow: hidden;
        }
        
        .sidebar-header {
            padding: 1.5rem 0.75rem;
        }
        
        .logo span, .menu-item span, .menu-category {
            display: none;
        }
        
        .menu-item {
            justify-content: center;
            padding: 0.75rem 0;
        }
        
        .menu-item i {
            margin: 0;
        }
        
        .main-content {
            margin-left: 70px;
        }
    }

    @media (max-width: 640px) {
        .search-box {
            display: none;
        }
    }
    </style>
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    @stack('styles')
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            @include('partials.admin.header')

            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('partials.admin.footer')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>