@extends('admin.index')

@section('content')
<div class="container">
    <h2 style="color: white">Daftar Kategori</h2>
    <hr>
    <form action="{{ url('category/create') }}" method="post">
        @csrf
        <div>
            <input type="text" name="kategori" placeholder="Nama Kategori">
            <input class="btn btn-primary" type="submit" value="Tambah">
            <hr>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 70%;">Kategori</th>
                    <th class="text-center" style="width: 25%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category['judul'] }}</td>
                    <td class="d-flex justify-content-center">
                        <a class="btn btn-warning me-2 mr-2" href="{{ url('category/edit', $category['id']) }}"><i data-feather="edit"></i> Edit</a>
                        <a class="btn btn-danger me-2 mr-2" onclick="confirmation(event)" href="{{ url('category/delete', $category['id']) }}"><i data-feather="trash"></i> Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection
