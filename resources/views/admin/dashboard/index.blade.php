@extends('admin.index')
@section('content')
<div class="container-fluid">
    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-normal">Total Postingan</h6>
                            <h3 class="mb-0">{{ $total_posts }}</h3>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-normal">Total Gambar</h6>
                            <h3 class="mb-0">{{ $total_images }}</h3>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-images"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-normal">Total Pengunjung</h6>
                            <h3 class="mb-0">{{ $visitor_count }}</h3>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Postingan Terbaru -->
    <div class="row mt-4">
        <div class="col-12">
            <h5 class="mb-4">Postingan Terbaru</h5>
        </div>
        @foreach($recent_posts as $post)
        <div class="col-md-4">
            <div class="card h-100">
                @php
                    $firstImage = $post->gallery ? $post->gallery->images->first() : null;
                @endphp

                @if($firstImage)
                    <img src="{{ asset('images/' . $firstImage->file) }}" class="card-img-top" alt="{{ $post->judul }}" style="height: 200px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <h6 class="card-title">{{ $post->judul }}</h6>
                    <p class="card-text text-muted small">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ \Carbon\Carbon::parse($post->tanggal)->format('d M Y') }}
                    </p>
                    <span class="badge bg-primary text-white">{{ $post->category->judul }}</span>
                    <span class="badge bg-{{ $post->status == 'publish' ? 'success' : 'warning' }} text-white">
                        {{ $post->status }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(isset($error_message))
        <div class="alert alert-danger">
            {{ $error_message }}
        </div>
    @endif
</div>
@endsection

