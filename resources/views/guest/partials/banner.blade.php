<div id="home" class="banner_section layout_padding">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <h3 class="banner_text animate-text">Selamat Datang di Website Resmi</h3>
                    <h1 class="banner_taital animate-text">SMKN 4 KOTA BOGOR</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fundraise_section">
    <div class="container text-center">
        <h2 class="program_title animate-text">KOMPETENSI KEAHLIAN</h2>
    </div>
    <div class="fundraise_section_main">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6">
                <div class="box_main animate-box" data-delay="0">
                    <div class="icon_1">
                        <img src="{{asset('/guestcss/images/smkn4/pplg.png')}}" alt="PPLG">
                    </div>
                    <h4 class="volunteer_text">PPLG</h4>
                    <p class="lorem_text">Pengembangan Perangkat Lunak dan Gim</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="box_main animate-box" data-delay="200">
                    <div class="icon_tjkt">
                        <img src="{{asset('/guestcss/images/smkn4/tjkt.png')}}" alt="TJKT">
                    </div>
                    <h4 class="volunteer_text">TJKT</h4>
                    <p class="lorem_text">Teknik Jaringan Komputer dan Telekomunikasi</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="box_main animate-box" data-delay="400">
                    <div class="icon_1">
                        <img src="{{asset('/guestcss/images/smkn4/tkr.png')}}" alt="TO">
                    </div>
                    <h4 class="volunteer_text">TO</h4>
                    <p class="lorem_text">Teknik Otomotif</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="box_main animate-box" data-delay="600">
                    <div class="icon_1">
                        <img src="{{asset('/guestcss/images/smkn4/tflm.png')}}" alt="TFLM">
                    </div>
                    <h4 class="volunteer_text">TFLM</h4>
                    <p class="lorem_text">Teknik Fabrikasi Logam dan Manufaktur</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function animateOnScroll() {
        const elements = document.querySelectorAll('.animate-text, .animate-box, .box_main, .about_text, .about_taital');
        const windowHeight = window.innerHeight;
        const triggerPoint = 150;

        elements.forEach((element, index) => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;

            // Menambahkan class animasi berdasarkan posisi elemen
            if (elementTop < windowHeight - triggerPoint && elementBottom > 0) {
                // Menentukan arah animasi berdasarkan posisi elemen
                if (index % 3 === 0) {
                    element.classList.add('slide-from-left');
                } else if (index % 3 === 1) {
                    element.classList.add('slide-from-right');
                } else {
                    element.classList.add('scale-in');
                }

                // Menambahkan delay untuk setiap elemen
                setTimeout(() => {
                    element.classList.add('visible');
                }, index * 200);
            }
        });
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

<style>
.box_main {
    transform: translateY(50px);
    opacity: 0;
    transition: all 0.8s ease;
}

.box_main.visible {
    transform: translateY(0);
    opacity: 1;
}

/* Efek hover untuk box */
.box_main:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

/* Animasi untuk gambar */
.icon_1 img, .icon_tjkt img {
    transition: all 0.5s ease;
}

.box_main:hover .icon_1 img,
.box_main:hover .icon_tjkt img {
    transform: scale(1.1) rotate(5deg);
}

/* Animasi untuk teks */
.volunteer_text, .lorem_text {
    transition: all 0.3s ease;
}

.box_main:hover .volunteer_text {
    color: #120a78;
}

.box_main:hover .lorem_text {
    color: #333;
}
</style>
