@extends('layouts.header-footer')

@section('title', 'Chi tiết người dùng')

@section('content')
<div class="container mt-5">
    @include('components.breadcrumb', ['breadcrumbs' => ['Users', 'Detail']])
    <h2 class="text-center mb-4">Chi tiết người dùng</h2>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header bg-info text-white text-center">
            <h5>Thông tin User</h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-4">ID</dt>
              <dd class="col-sm-8">{{ $user->id }}</dd>

              <dt class="col-sm-4">Username</dt>
              <dd class="col-sm-8">{{ $user->name }}</dd>

              <dt class="col-sm-4">Email</dt>
              <dd class="col-sm-8">{{ $user->email }}</dd>

              <dt class="col-sm-4">Phone</dt>
              <dd class="col-sm-8">{{ $user->phone }}</dd>

              <dt class="col-sm-4">Address</dt>
              <dd class="col-sm-8">{{ $user->address }}</dd>

              <dt class="col-sm-4">Ngày tạo</dt>
              <dd class="col-sm-8">{{ $user->created_at }}</dd>
            </dl>
            <div class="d-flex justify-content-end mt-3">
              <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Back</a>

              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">Edit</a>

              <form action="{{ route('users.delete', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection