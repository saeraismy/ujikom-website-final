<!DOCTYPE html>
<html lang="en">

<head>
    @include('guest.partials.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="{{ asset('images/logoSMKN4.png') }}">
</head>

<body>
    <!-- header section start -->
    @include('guest.partials.header')
    <!-- header section end -->
    <!-- banner section start -->
    @include('guest.partials.banner')
    <!-- banner section end -->
    <!-- about section start -->
    <div id="tentang" class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="about_taital">Tentang SMK NEGERI 4 BOGOR</h2>
                    <p class="about_text">Merupakan sekolah kejuruan berbasis Teknologi Informasi dan Komunikasi.
                        Sekolah ini didirikan dan dirintis pada tahun 2008 kemudian dibuka pada tahun 2009 yang saat ini
                        terakreditasi A.
                        Terletak di Jalan Raya Tajur Kp. Buntar, Muarasari, Bogor, sekolah ini berdiri di atas lahan
                        seluas 12.724 m2 dengan berbagai fasilitas pendukung di dalamnya.
                        Terdapat 54 staff pengajar dan 22 orang staff tata usaha, dikepalai oleh Drs. Mulya
                        Mulprihartono, M. Si, sekolah ini merupakan investasi pendidikan yang tepat untuk putra/putri
                        anda.
                    </p>
                </div>
                <div class="col-sm-4">
                    <div class="about_img"><img src="{{ asset('/guestcss/images/smkn4/smkn4bogor.jpg') }}"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->
    <!-- agenda section start -->
    @include('guest.partials.agenda')
    <!-- agenda section end -->
    <!-- informasi section start -->
    @include('guest.partials.informasi', ['informasi' => $informasi])
    <!-- informasi section end -->
    <!-- galeri section start -->
    @include('guest.partials.galeri', ['images' => $images])
    <!-- galeri section end -->

    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            @include('guest.partials.footer')
            <p class="copyright_text">2024 All Rights Reserved</p>
        </div>
    </div>
    <!-- copyright section end -->
    <!-- Pastikan jQuery dimuat sebelum Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Javascript files-->
    @include('guest.partials.javascript')
    @stack('scripts')

    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
</body>

</html>
