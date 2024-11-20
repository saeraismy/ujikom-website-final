@extends('admin.index')

@section('content')
    <div class="container">
        <h1 style="color: white">Post</h1>
        <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="{{ url('/post/search') }}" method="get" class="form-inline">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" id="search" required style="width: 250px;">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i data-feather="search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            @if(request()->has('search'))
                <a href="{{ url('/post') }}" class="btn btn-secondary btn-sm">
                    <i data-feather="refresh-cw" style="width: 14px; height: 14px;"></i> Reset
                </a>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th style="width: 3%;">No</th>
                                <th style="width: 12%;">Judul</th>
                                <th style="width: 15%;">Isi</th>
                                <th style="width: 10%;">Kategori</th>
                                <th style="width: 10%;">Petugas</th>
                                <th style="width: 8%;">Status</th>
                                <th style="width: 10%;">Tanggal</th>
                                <th style="width: 10%;">Dibuat Pada</th>
                                <th style="width: 15%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration + ($posts->currentPage()-1) * $posts->perPage() }}</td>
                                    <td>{{ Str::limit($post['judul'], 30) }}</td>
                                    <td>{{ Str::limit($post['isi'], 30) }}</td>
                                    <td>{{ $post['category']['judul'] }}</td>
                                    <td>{{ $post['user']['username'] ?? 'Tidak ada petugas' }}</td>
                                    <td>
                                        @if (Str::lower($post['status']) == 'publish')
                                            <span class="badge bg-success text-white">{{ $post['status'] }}</span>
                                        @else
                                            <span class="badge bg-warning text-white">{{ $post['status'] }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $post['tanggal'] ? \Carbon\Carbon::parse($post['tanggal'])->format('d M y') : '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($post['created_at'])->format('d M y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('post/edit', $post['id']) }}" class="btn btn-warning btn-sm me-1"><i data-feather="edit"></i></a>
                                        <a class="btn btn-danger btn-sm" onclick="confirmation(event)" href="{{ url('post/delete', $post['id']) }}"><i data-feather="trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
