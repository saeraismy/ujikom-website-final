@extends('admin.index')

@section('content')
<div class="container">
    <h2 style="color: white">Edit Petugas</h2>
    <form action="{{ url('/petugas/update/'.$data['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" value="{{ $data['username'] }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ $data['email'] }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password (Kosongkan jika tidak diubah):</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('/petugas') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
