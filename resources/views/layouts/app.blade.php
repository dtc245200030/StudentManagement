<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Sinh Viên - Đề 2</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/"><i class="fa-solid fa-graduation-cap me-2"></i>QUẢN LÝ SINH VIÊN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('classes*') || request()->is('/') ? 'active fw-bold' : '' }}" href="{{ route('classes.index') }}">
                            <i class="fa-solid fa-school me-1"></i> Quản Lý Lớp
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('students*') ? 'active fw-bold' : '' }}" href="{{ route('students.index') }}">
                            <i class="fa-solid fa-users me-1"></i> Quản Lý Sinh Viên
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('grades*') ? 'active fw-bold' : '' }}" href="{{ route('grades.index') }}">
                            <i class="fa-solid fa-star me-1"></i> Quản Lý Điểm Số
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
