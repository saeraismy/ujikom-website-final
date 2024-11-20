<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="avatar d-flex align-items-center justify-content-center">
        <i class="icon-user" style="font-size: 2.5em; color: #aaa3e3; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;"></i>
      </div>
      <div class="title">
        <h1 class="h5">{{ Auth::user()->username }}</h1>
        <p>{{ Auth::user()->email }}</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus-->

    <span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
              <a href="{{ url('dashboard') }}"> <i class="icon-home"></i>Home</a>
            </li>

            <li class="{{ Request::is('petugas') ? 'active' : '' }}">
              <a href="{{ url('petugas') }}"> <i class="icon-user"></i>Petugas</a>
            </li>

            <li class="{{ Request::is('category') ? 'active' : '' }}">
              <a href="{{ url('category') }}"> <i class="icon-grid"></i>Kategori </a>
            </li>

            <li class="{{ Request::is('post*') ? 'active' : '' }}">
              <a href="#exampledropdownDropdown" aria-expanded="{{ Request::is('post*') ? 'true' : 'false' }}" data-toggle="collapse">
                <i class="icon-windows"></i>Post
              </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled {{ Request::is('post*') ? 'show' : '' }}">
                <li class="{{ Request::is('post/create') ? 'active' : '' }}">
                  <a href="{{ url('post/create') }}">Tambah Post</a>
                </li>
                <li class="{{ Request::is('post') ? 'active' : '' }}">
                  <a href="{{ url('post') }}">Data Post</a>
                </li>
              </ul>
            </li>

            <li class="{{ Request::is('gallery') ? 'active' : '' }}">
              <a href="{{ url('gallery') }}"> <i class="icon-picture"></i>Galeri</a>
            </li>
    </ul>
  </nav>
