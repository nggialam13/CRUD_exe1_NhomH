@extends('layouts.header-footer')

@section('title', 'Thùng rác')

@section('content')

        <h2 class="text-center mb-4">🗑️ Danh sách user đã xóa</h2>

        <div class="mb-3">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                ← Quay lại danh sách
            </a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="text-center">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td class="text-center">

                            <!-- Restore -->
                            <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    ♻️ Khôi phục
                                </button>
                            </form>

                            <!-- Force Delete -->
                            <form action="{{ route('users.forceDelete', $user->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Xóa vĩnh viễn user này?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    💀 Xóa vĩnh viễn
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Không có user nào đã xóa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>

@endsection