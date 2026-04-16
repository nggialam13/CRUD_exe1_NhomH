@extends('layouts.header-footer')

@section('title', 'Danh sách người dùng')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh sách người dùng</h2>
        <div class="alert alert-info mt-3 text-center">
            <strong>Tổng số người dùng: {{ $users->total() }}</strong>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-between">
            <div>

                @auth
                    @if(auth()->user()->role == 1)
                        <a href="{{ route('users.create') }}" class="btn btn-success">
                            + Thêm User
                        </a>

                        <a href="{{ route('users.trashed') }}" class="btn btn-danger">
                            🗑️ Thùng rác
                        </a>
                    @endif
                @endauth
            </div>
        </div>

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
                    @php
                        // Highlight search keywords in name and email
                        $highlightedName = $search ? str_ireplace($search, '<mark>' . $search . '</mark>', $user->name) : $user->name;
                        $highlightedEmail = $search ? str_ireplace($search, '<mark>' . $search . '</mark>', $user->email) : $user->email;
                    @endphp
                    <tr>
                        <td class="text-center">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>
                        <td>{!! $highlightedName !!}</td>
                        <td>{!! $highlightedEmail !!}</td>
                        <td class="text-center">
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary btn-sm">View</a>
                            @auth
                                @if(auth()->user()->role == 1)
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;"
                                        onsubmit="return confirm('Bạn có chắc muốn xoá không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            @endauth

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $users->appends(['search' => $search])->links() }}
        </div>


    </div>
@endsection