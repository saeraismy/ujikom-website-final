@extends('admin.index')
@section('content')
    <h1 style="color: white">Edit Kategori</h1>
    <div class="div_deg">
        <form action="{{ url('category/update', $data['id']) }}" method="post">
            @csrf
            <input type="text" name="kategori" value="{{ $data['judul'] }}">
            <input class="btn btn-primary" type="submit" value="Update">
        </form>
    </div>
@endsection
