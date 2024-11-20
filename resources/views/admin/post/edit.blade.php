@extends('admin.index')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/post/update/'.$data['id'] )}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" id="judul" required value="{{ $data['judul'] }}">
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="category_id">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control"  required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($category as $cat)
                                <option value="{{ $cat['id'] }}" @if ($cat['id'] == $data['category_id']) selected @endif>
                                    {{ $cat['judul'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control"  required>
                                <option value="">Pilih Status</option>
                                <option value="publish" @if ($data['status'] == 'publish') selected @endif>Publish</option>
                                <option value="draft" @if ($data['status'] == 'draft') selected @endif>Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $data['tanggal'] }}">
                        </div>
                    </div>
                </div>

                <div class="form-group-mb-3">
                    <label for="isi">Isi</label>
                    <textarea type="text" name="isi" class="form-control" id="isi" required>{{ $data['isi'] }}</textarea>
                </div>
                <br>
                <a href="{{ url('/post') }}" class="btn btn-secondary ms-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
