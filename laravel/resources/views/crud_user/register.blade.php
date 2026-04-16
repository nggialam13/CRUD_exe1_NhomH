@extends('layouts.header-footer')

@section('title', 'Đăng ký')

@section('content')
<div class="container mt-5">
    @include('components.breadcrumb', ['breadcrumbs' => ['Users', 'Create']])
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Đăng ký</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <input name="name" class="form-control mb-2" placeholder="Tên">

                            <input name="email" class="form-control mb-2" placeholder="Email">

                            <input type="password" name="password" class="form-control mb-2" placeholder="Password">

                            <input name="phone" class="form-control mb-2" placeholder="Phone">

                            <input name="address" class="form-control mb-2" placeholder="Address">

                            <button class="btn btn-success">Thêm User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection