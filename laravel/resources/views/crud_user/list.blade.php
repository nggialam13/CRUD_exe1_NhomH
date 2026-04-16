<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Cập nhật</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Laravel Nhóm H</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <!-- Phùng Đình Hạnh -->
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link"
                                    style="display: inline; padding: 0; border: none; background: none;">Đăng xuất</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
        <h2 class="text-center mb-4">Danh sách người dùng</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- thêm user-->
        <div class="mb-3">
            <a href="{{ route('users.create') }}" class="btn btn-success">
                + Thêm User
            </a>

            <a href="{{ route('users.trashed') }}" class="btn btn-danger">
                🗑️ Thùng rác
            </a>
        </div>
        <!-- thêm form search-->
        <form method="GET" action="{{ route('users.index') }}" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm theo tên hoặc email"
                value="{{ $search }}">

            <button class="btn btn-primary">Search</button>
        </form>
        <table class="table table-bordered table-striped">
            <thead class="table-light text-center">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary btn-sm">View</a>

                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc muốn xoá không?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <!-- search user + phân trang  -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->appends(['search' => $search])->links() }}
        </div>


    </main>



    <footer class="bg-dark text-white text-center p-3 mt-5">
        <small>&copy; Lập trình web Nhóm H</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>