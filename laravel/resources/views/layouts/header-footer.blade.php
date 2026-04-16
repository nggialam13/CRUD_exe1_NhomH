<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Nhóm H')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Laravel Nhóm H</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto" style="gap: 0.5rem;">
                    @auth
                    <li class="nav-item"><a class="nav-link ps-2 pe-2" href="{{ route('users.index') }}" style="white-space: nowrap;">Danh sách User</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link ps-2 pe-2" style="border: none; background: none; white-space: nowrap;">Đăng xuất</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link ps-2 pe-2" href="{{ route('login') }}" style="white-space: nowrap;">Đăng nhập</a></li>
                    <li class="nav-item"><a class="nav-link ps-2 pe-2" href="{{ route('users.create') }}" style="white-space: nowrap;">Đăng ký</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center p-3 mt-5">
        <small>&copy; Lập trình web Nhóm H</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>