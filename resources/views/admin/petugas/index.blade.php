@extends('admin.index')

@section('content')
<div class="container">
    <h2 style="color: white">Daftar Petugas</h2>
    <hr>
    <a href="{{ url('petugas/create') }}" class="btn btn-primary">Tambah Petugas</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $petugas)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $petugas['username'] }}</td>
                <td>{{ $petugas['email'] }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ url('petugas/edit', $petugas['id']) }}" class="btn btn-warning me-2 mr-2"><i data-feather="edit"></i> Edit</a>
                    <a class="btn btn-danger me-2 mr-2" onclick="confirmation(event)" href="{{ url('petugas/delete', $petugas['id']) }}"><i data-feather="trash"></i> Hapus</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada data petugas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
