@extends('admin.index')
@section('content')
    <div class="container">
        <h1 style="color: white">Edit Galeri</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ url('gallery/update/'.$data['id']) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group mb-3">
                        <label for="post_id" class="form-label">Judul Post</label>
                        <select name="post_id" class="form-control" id="post_id" required>
                            <option value="">Pilih Post</option>
                            @foreach ($posts as $post)
                            <option value="{{ $post['id'] }}" @if ($post['id'] == $data['post_id']) selected @endif>{{ $post['judul'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="posisi" class="form-label">Posisi</label>
                                <input type="number" name="posisi" class="form-control" id="posisi" value="{{ $data['posisi'] }}" required>
                                <small>Nilai posisi harus berupa angka</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif" @if ($data['status'] == 'Aktif') selected @endif>Aktif</option>
                                <option value="Tidak-Aktif" @if ($data['status'] == 'Tidak-Aktif') selected @endif>Tidak Aktif</option>
                               </select>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/gallery') }}" class="btn btn-secondary ms-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
