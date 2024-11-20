<div id="galeri" class="mission_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="mission_taital animate-text">Galeri Sekolah</h1>
                <p class="mission_text animate-text">Dokumentasi kegiatan dan momen berharga di sekolah kami</p>
            </div>
        </div>
    </div>
    @if(isset($images) && $images->count() > 0)
        <div class="mission_section_2">
            <div class="row">
                @foreach($images as $galleryId => $gallery)
                <div class="col-md-3 mb-4">
                    <div class="container_main gallery-item animate-box" data-gallery-id="{{ $galleryId }}" data-delay="{{ $loop->index * 100 }}">
                        <img src="{{ asset('images/' . $gallery['images'][0]['file']) }}" alt="{{ $gallery['gallery_name'] }}" class="image">
                        <div class="overlay">
                            <div class="text">
                                <h4 class="some_text">{{ $gallery['gallery_name'] }}</h4>
                                <p class="text-white">{{ count($gallery['images']) }} Foto</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Lightbox Container -->
        <div id="lightbox" class="lightbox">
            <button class="lightbox-close">&times;</button>
            <button class="lightbox-nav prev-btn">&lt;</button>
            <button class="lightbox-nav next-btn">&gt;</button>
            <div class="lightbox-content">
                <img src="" alt="" class="lightbox-image">
                <div class="lightbox-caption">
                    <h3 class="gallery-title"></h3>
                    <p class="image-title"></p>
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <p>Tidak ada gambar yang tersedia</p>
        </div>
    @endif
</div>

@push('scripts')
<script>
$(document).ready(function() {
    const galleries = @json($images);
    let currentGallery = null;
    let currentImageIndex = 0;

    // Klik pada gallery item
    $('.gallery-item').click(function() {
        const galleryId = $(this).data('gallery-id');
        currentGallery = galleries[galleryId];
        currentImageIndex = 0;
        showLightbox();
    });

    // Fungsi untuk menampilkan lightbox
    function showLightbox() {
        const image = currentGallery.images[currentImageIndex];
        const lightbox = $('#lightbox');

        $('.lightbox-image').attr('src', `{{ asset('images/') }}/${image.file}`);
        $('.gallery-title').text(currentGallery.gallery_name);
        $('.image-title').text(image.judul);

        lightbox.css('display', 'block');
        // Trigger reflow
        lightbox[0].offsetHeight;
        // Tambahkan class show untuk memulai animasi
        lightbox.addClass('show');
        updateNavButtons();
    }

    // Fungsi untuk menutup lightbox
    function closeLightbox() {
        const lightbox = $('#lightbox');
        lightbox.removeClass('show');
        // Tunggu animasi selesai sebelum menyembunyikan lightbox
        setTimeout(() => {
            lightbox.css('display', 'none');
        }, 500); // Sesuaikan dengan durasi transisi CSS
    }

    // Update tombol navigasi
    function updateNavButtons() {
        $('.prev-btn').toggle(currentImageIndex > 0);
        $('.next-btn').toggle(currentImageIndex < currentGallery.images.length - 1);
    }

    // Navigasi ke gambar sebelumnya
    $('.prev-btn').click(function(e) {
        e.stopPropagation();
        if (currentImageIndex > 0) {
            currentImageIndex--;
            updateLightboxContent();
        }
    });

    // Navigasi ke gambar selanjutnya
    $('.next-btn').click(function(e) {
        e.stopPropagation();
        if (currentImageIndex < currentGallery.images.length - 1) {
            currentImageIndex++;
            updateLightboxContent();
        }
    });

    // Fungsi untuk update konten lightbox dengan transisi
    function updateLightboxContent() {
        const image = currentGallery.images[currentImageIndex];
        const lightboxContent = $('.lightbox-content');

        // Fade out konten
        lightboxContent.css('opacity', '0');

        setTimeout(() => {
            // Update konten
            $('.lightbox-image').attr('src', `{{ asset('images/') }}/${image.file}`);
            $('.gallery-title').text(currentGallery.gallery_name);
            $('.image-title').text(image.judul);

            // Fade in konten
            lightboxContent.css('opacity', '1');
            updateNavButtons();
        }, 300);
    }

    // Tutup lightbox
    $('.lightbox-close').click(function() {
        closeLightbox();
    });

    // Tutup lightbox dengan tombol ESC
    $(document).keyup(function(e) {
        if (e.key === "Escape") {
            closeLightbox();
        }
    });

    // Navigasi dengan keyboard
    $(document).keyup(function(e) {
        if ($('#lightbox').is(':visible')) {
            if (e.key === "ArrowLeft" && currentImageIndex > 0) {
                currentImageIndex--;
                updateLightboxContent();
            }
            if (e.key === "ArrowRight" && currentImageIndex < currentGallery.images.length - 1) {
                currentImageIndex++;
                updateLightboxContent();
            }
        }
    });
});
</script>

<style>
.gallery-item {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
    cursor: pointer;
}

.gallery-item.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Style untuk container dan overlay */
.container_main {
    position: relative;
    transition: all 0.3s ease;
}

.container_main:hover {
    transform: translateY(-5px);
}

.image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
    border-radius: 8px;
}

.overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    opacity: 0;
    transition: all 0.3s ease;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 8px;
}

.container_main:hover .overlay {
    opacity: 1;
}

.text {
    color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 90%;
}

/* Style untuk lightbox */
.lightbox {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0);
    z-index: 9999;
    transition: background-color 0.3s ease;
    opacity: 0;
}

.lightbox.show {
    background-color: rgba(0, 0, 0, 0.75);
    opacity: 1;
}

.lightbox-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.9);  /* Mulai sedikit lebih kecil */
    text-align: center;
    width: 90%;
    max-width: 1200px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    opacity: 0;  /* Mulai transparan */
    transition: all 0.5s ease;  /* Transisi untuk semua perubahan */
}

.lightbox.show .lightbox-content {
    transform: translate(-50%, -50%) scale(1);  /* Skala normal saat ditampilkan */
    opacity: 1;
}

.lightbox-image {
    max-height: 75vh;
    max-width: 100%;
    object-fit: contain;
    margin: 0 auto;
    display: block;
}

.lightbox-caption {
    color: white;
    margin-top: 15px;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px 20px;
    border-radius: 8px;
    max-width: 80%;
}

.gallery-title {
    font-size: 22px;
    margin-bottom: 5px;
    color: #fff;
}

.image-title {
    font-size: 16px;
    margin: 0;
    color: #eee;
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 30px;
    color: white;
    background: rgba(0, 0, 0, 0.3);
    border: none;
    cursor: pointer;
    z-index: 10000;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s;
}

.lightbox-close:hover {
    background: rgba(0, 0, 0, 0.5);
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.3);
    color: white;
    border: none;
    width: 40px;
    height: 60px;
    font-size: 24px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
}

.lightbox-nav:hover {
    background: rgba(0, 0, 0, 0.5);
}

.prev-btn {
    left: 20px;
}

.next-btn {
    right: 20px;
}

@media (max-width: 768px) {
    .lightbox-nav {
        width: 35px;
        height: 50px;
        font-size: 18px;
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

    .gallery-title {
        font-size: 18px;
    }

    .image-title {
        font-size: 14px;
    }

    .lightbox-caption {
        padding: 8px 15px;
        max-width: 90%;
    }

    .lightbox-image {
        max-height: 70vh;
    }
}

.mission_taital {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.5s ease;
}

.mission_taital.visible {
    opacity: 1;
    transform: translateY(0);
}
<script>
    function animateGallery() {
        elements.forEach(element => {
            const rect = element.getBoundingClientRect();
            const delay = element.dataset.delay || 0;

            if (rect.top <= windowHeight - 50) {
                setTimeout(() => {
                    element.classList.add('visible');
                }, delay); 
            } else {
                element.classList.remove('visible');
            }
        });
    }
    setTimeout(animateGallery, 50);


    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                animateGallery();
                ticking = false;
            });
            ticking = true;
        }
    });
});
</script>
@endpush
