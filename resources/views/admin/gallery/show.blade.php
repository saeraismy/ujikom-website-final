@extends('admin.index')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ url('gallery') }}" class="btn btn-secondary">
                <i data-feather="arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Judul Post</td>
                            <td>:</td>
                            <td>{{ $gallery['post']['judul'] }}</td>
                        </tr>
                        <tr>
                            <td>Posisi</td>
                            <td>:</td>
                            <td>{{ $gallery['posisi'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                @if (Str::lower($gallery['status']) === 'aktif')
                                    <span class="badge bg-success">{{ $gallery['status'] }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $gallery['status'] }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dibuat Pada</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($gallery['created_at'])->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="m-0 p-0"><i data-feather="image"></i> Foto</h4>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#addImageModal">
                        + Foto
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="/images/create" method="post" enctype="multipart/form-data" class="modal-content">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addImageModalLabel">Tambah Foto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="gallery_id" value="{{ $gallery['id'] }}">
                                    <div class="mb-3">
                                        <label for="file">Foto</label>
                                        <input type="file" class="form-control" id="file" name="file" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control w-100" name="judul" id="judul" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($gallery['images'] as $image)
                        <div class="col-12 col-md-4">
                            <div class="card">
                                    <img src="{{ asset('images/' . $image['file']) }}" alt="{{ $image['judul'] }}" class="img-fluid">
                                <div class="p-2">
                                    <h5>{{ $image['judul'] }}</h5>
                                    <a class="btn btn-danger me-2 mr-2" onclick="confirmation(event)"
                                    href="{{ url('images', $image['id']) }}"><i data-feather="trash"></i></a>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning">Tidak Ada Foto.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
