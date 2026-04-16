@extends('layouts.header-footer')

@section('title', 'Cập nhật người dùng')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Cập nhật</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf

                            <input name="name" class="form-control mb-2" value="{{ $user->name }}" placeholder="Tên">

                            <input name="email" class="form-control mb-2" value="{{ $user->email }}"
                                placeholder="Email">

                            <input type="password" name="password" class="form-control mb-2"
                                placeholder="Nhập password mới (nếu muốn đổi)">

                            <input name="phone" class="form-control mb-2" value="{{ $user->phone }}"
                                placeholder="Phone">

                            <input name="address" class="form-control mb-2" value="{{ $user->address }}"
                                placeholder="Address">

                            <button class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection