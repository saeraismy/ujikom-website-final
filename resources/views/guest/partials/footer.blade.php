<div class="footer_contact_map_section">
    <div class="container">
        <div class="row">
            <!-- Contact Section (left side) -->
            <div class="col-sm-5 contact-info">
                <h3>Kontak Kami</h3>
                <div class="contact-links">
                    <!-- Email dengan teks -->
                    <div class="contact-item">
                        <a href="mailto:smkn4@smkn4bogor.sch.id" target="_blank">
                            <i class="fas fa-envelope"></i>
                            <span>smkn4@smkn4bogor.sch.id</span>
                        </a>
                    </div>

                    <!-- WhatsApp dengan teks -->
                    <div class="contact-item">
                        <a href="https://wa.me/6282260168886" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>+62 822-6016-8886</span>
                        </a>
                    </div>

                    <!-- Facebook dengan teks -->
                    <div class="contact-item">
                        <a href="https://facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                            <span>SMK NEGERI 4 KOTA BOGOR</span>
                        </a>
                    </div>

                    <!-- Instagram dengan teks -->
                    <div class="contact-item">
                        <a href="https://www.instagram.com/smkn4kotabogor/" target="_blank">
                            <i class="fab fa-instagram"></i>
                            <span>@smkn4kotabogor</span>
                        </a>
                    </div>

                    <!-- Youtube dengan teks -->
                    <div class="contact-item">
                        <a href="https://youtube.com/@smknegeri4bogor905?si=NIjlkfxgTE61EiRc" target="_blank">
                            <i class="fab fa-youtube"></i>
                            <span>SMK Negeri 4 Bogor</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Map Section (right side) -->
            <div class="col-sm-7">
                <h3 class="location-title">Lokasi Kami</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.0498396124594!2d106.82211897362737!3d-6.640733393353769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1731556764092!5m2!1sid!2sid"
                    width="100%"
                    height="150"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<a href="javascript:void(0)" class="back-to-top">
    <i class="fas fa-arrow-up"></i>
    <span>Kembali ke Atas</span>
</a>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var backToTop = document.querySelector('.back-to-top');

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });

    backToTop.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

        if (window.location.hash) {
            history.pushState('', document.title, window.location.pathname + window.location.search);
        }
    });
});
</script>
