@extends('admin.index')

@section('content')
    <div class="container">
        <h2 style="color: white">Galeri</h2>
        <hr>
        <a href="{{ url('gallery/create') }}" class="btn btn-primary">Tambah Galeri</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Post</th>
                    <th>Posisi</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $gallery)
                    <tr>
                        <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td> <!-- Di sini -->
                        <td>{{ $gallery['post']['judul'] }}</td>
                        <td>{{ $gallery['posisi'] }}</td>
                        <td>
                            @if (Str::lower($gallery['status']) == 'aktif')
                                <span class="badge bg-success">{{ $gallery['status'] }}</span>
                            @else
                                <span class="badge bg-warning">{{ $gallery['status'] }}</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ url('gallery', $gallery['id']) }}" class="btn btn-success me-2 mr-2"><i
                                    data-feather="info"></i> Info</a>
                            <a href="{{ url('gallery/edit', $gallery['id']) }}" class="btn btn-warning me-2 mr-2"><i
                                    data-feather="edit"></i> Edit</a>
                            <a class="btn btn-danger me-2 mr-2" onclick="confirmation(event)"
                                href="{{ url('gallery/delete', $gallery['id']) }}"><i data-feather="trash"></i> Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
