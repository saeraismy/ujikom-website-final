<div class="header_section">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="d-flex align-items-center">
            <a class="navbar-brand mr-1" href="#tentang">
                <img src="{{asset('/guestcss/images/smkn4/logoSMKN4.png')}}" alt="Logo">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#agenda">Agenda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#informasi">Informasi</a>
                </li>
                <li class="nav-item"></li>
                    <a class="nav-link" href="#galeri">Galeri</a>
                </li>
            </ul>
        </div>
     </nav>
</div>

<style>
.navbar {
    animation: slideDown 0.5s ease forwards;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.nav-item {
    opacity: 0;
    animation: fadeIn 0.5s ease forwards;
}

.nav-item:nth-child(1) { animation-delay: 0.2s; }
.nav-item:nth-child(2) { animation-delay: 0.3s; }
.nav-item:nth-child(3) { animation-delay: 0.4s; }
.nav-item:nth-child(4) { animation-delay: 0.5s; }

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
