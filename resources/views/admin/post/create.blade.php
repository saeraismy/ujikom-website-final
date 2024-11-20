@extends('admin.index')
@section('content')
    <div class="container">
        <h1 style="color: white">Tambah Post</h1>
        <div class="card">
            <div class="card-body">
                <form action="/post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="category_id">Kategori</label>
                               <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($category as $cat)
                                <option value="{{ $cat['id'] }}">{{ $cat['judul'] }}</option>
                                @endforeach
                               </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                               </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal">
                            </div>
                        </div>
                    </div>
                    <div class=" form-group mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea type="text" name="isi" class="form-control" id="isi" required></textarea>
                    </div>
                    <a href="{{ url('/post') }}" class="btn btn-secondary ms-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
