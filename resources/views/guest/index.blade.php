<!DOCTYPE html>
<html lang="en">

<head>
    @include('guest.partials.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="{{ asset('images/logoSMKN4.png') }}">
    <style>
    /* Animasi dasar untuk elemen yang akan dianimasikan */
    .animate-text, .animate-box, .box_main, .about_text, .about_taital {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }

    /* Animasi ketika elemen menjadi visible */
    .animate-text.visible,
    .animate-box.visible,
    .box_main.visible,
    .about_text.visible,
    .about_taital.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Animasi untuk box yang bergerak dari kiri */
    .slide-from-left {
        opacity: 0;
        transform: translateX(-100px);
        transition: all 0.8s ease;
    }

    /* Animasi untuk box yang bergerak dari kanan */
    .slide-from-right {
        opacity: 0;
        transform: translateX(100px);
        transition: all 0.8s ease;
    }

    .slide-from-left.visible,
    .slide-from-right.visible {
        opacity: 1;
        transform: translateX(0);
    }

    /* Animasi untuk scaling */
    .scale-in {
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.8s ease;
    }

    .scale-in.visible {
        opacity: 1;
        transform: scale(1);
    }

    /* Tambahkan transisi yang lebih smooth */
    .animate-text, .animate-box, .box_main, .about_text, .about_taital,
    .slide-from-left, .slide-from-right, .scale-in {
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s ease-out;
    }

    .animate-on-scroll.show {
        opacity: 1;
        transform: translateY(0);
    }
    </style>
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let lastScrollTop = 0; // Untuk mendeteksi arah scroll

        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-text, .animate-box, .box_main, .about_text, .about_taital');
            const windowHeight = window.innerHeight;
            const triggerPoint = 150;
            const st = window.pageYOffset || document.documentElement.scrollTop;
            const scrollingDown = st > lastScrollTop;

            elements.forEach((element, index) => {
                const elementTop = element.getBoundingClientRect().top;
                const elementBottom = element.getBoundingClientRect().bottom;
                const elementCenterY = elementTop + (element.offsetHeight / 2);

                // Elemen dalam viewport
                if (elementTop < windowHeight - triggerPoint && elementBottom > 0) {
                    // Menentukan arah animasi berdasarkan arah scroll dan posisi elemen
                    if (scrollingDown) {
                        if (index % 3 === 0) {
                            element.classList.add('slide-from-left');
                        } else if (index % 3 === 1) {
                            element.classList.add('slide-from-right');
                        } else {
                            element.classList.add('scale-in');
                        }
                    } else {
                        // Animasi saat scroll ke atas
                        if (index % 3 === 0) {
                            element.classList.add('slide-from-right');
                        } else if (index % 3 === 1) {
                            element.classList.add('slide-from-left');
                        } else {
                            element.classList.add('scale-in');
                        }
                    }

                    setTimeout(() => {
                        element.classList.add('visible');
                    }, index * 200);
                } else {
                    // Hapus class saat elemen keluar dari viewport
                    if ((scrollingDown && elementTop > windowHeight) ||
                        (!scrollingDown && elementBottom < 0)) {
                        element.classList.remove('visible', 'slide-from-left', 'slide-from-right', 'scale-in');
                    }
                }
            });

            lastScrollTop = st <= 0 ? 0 : st; // Untuk Mobile atau negative scrolling
        }

        // Jalankan animasi saat halaman dimuat
        setTimeout(animateOnScroll, 300);

        // Optimasi scroll event dengan throttling
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    animateOnScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Tambahkan event listener untuk resize window
        window.addEventListener('resize', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    animateOnScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.animate-on-scroll');

            function checkScroll() {
                elements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (elementTop < windowHeight * 0.9) {
                        element.classList.add('show');
                    } else {
                        element.classList.remove('show');
                    }
                });
            }

            window.addEventListener('scroll', checkScroll);
            checkScroll(); // Check on initial load
        });
    </script>
</body>

</html>
