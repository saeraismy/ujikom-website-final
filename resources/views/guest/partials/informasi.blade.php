<div id="informasi" class="informasi_section layout_padding">
    <div class="container">
       <h1 class="informasi_taital">Informasi Terkini</h1>
       <div class="informasi_taital_main">
          <div id="main_slider" class="carousel slide" data-ride="carousel">
             <div class="carousel-inner">
                @forelse($informasi as $index => $info)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row align-items-center">
                            @if(isset($info['gallery']) && isset($info['gallery']['images']) && count($info['gallery']['images']) > 0)
                                <div class="col-md-4">
                                    <div class="client_img text-center">
                                        <img src="{{ asset('images/' . $info['gallery']['images'][0]['file']) }}"
                                             alt="{{ $info['gallery']['images'][0]['judul'] }}"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="informasi_right">
                                        <h3 class="client_name_text">{{ $info['judul'] }}</h3>
                                        <div class="dummy_text">{{ $info['isi'] }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="informasi_right text-center mx-auto" style="max-width: 800px;">
                                        <h3 class="client_name_text">{{ $info['judul'] }}</h3>
                                        <div class="dummy_text">{{ $info['isi'] }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="informasi_right text-center">
                                    <h3 class="client_name_text">Tidak ada informasi</h3>
                                    <p class="dummy_text">Belum ada informasi yang dipublikasikan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
             </div>
             <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
             </a>
             <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
             </a>
          </div>
       </div>
    </div>
</div>

<style>
.informasi_section {
    width: 100%;
    float: left;
    background-color: #120a78;
    height: auto;
    padding: 30px 0;
}

.informasi_taital {
    width: 100%;
    font-size: 40px;
    color: #ffffff;
    text-align: center;
    text-transform: uppercase;
    font-family: 'Open Sans', sans-serif;
    margin-bottom: 20px;
}

.informasi_taital_main {
    width: 90%;
    border: 1px solid #b1afd1;
    padding: 20px;
    min-height: 400px;
    height: auto;
    max-width: 1000px;
    margin: 0 auto;
    border-radius: 10px;
}

.informasi_right {
    padding: 15px;
    height: 300px;
    overflow-y: auto;
    max-width: 90%;
    margin: 0 auto;
}

.client_img {
    width: 100%;
    height: 250px;
    overflow: hidden;
    border-radius: 8px;
}

.client_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.client_name_text {
    color: #ffffff;
    margin-bottom: 15px;
}

.dummy_text {
    color: #ffffff;
    margin: 0;
    padding: 0;
    text-align: justify;
}

/* Style untuk scrollbar */
.informasi_right::-webkit-scrollbar {
    width: 5px;
}

.informasi_right::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.1);
}

.informasi_right::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.5);
    border-radius: 10px;
}

/* Responsif untuk mobile */
@media (max-width: 768px) {
    .informasi_section {
        padding: 20px 0;
    }

    .informasi_taital_main {
        width: 95%;
        min-height: auto;
        padding: 15px;
    }

    .informasi_right {
        max-width: 100%;
    }

    .client_img {
        height: 150px;
        margin-bottom: 10px;
    }
}

/* Menambahkan media query baru untuk layar yang lebih besar */
@media (min-width: 1200px) {
    .informasi_taital_main {
        width: 80%;
        max-width: 1200px;
    }
}
</style>
