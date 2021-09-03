<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @include('inc.styles')
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">


                        <li class='sidebar-title'>Main Menu</li>



                        <li class="sidebar-item {{ Request::is(md5('user')) ? 'active' : '' }}">
                            <a href="{{ route('userIndex') }}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        {{-- <li class="sidebar-item has-sub {{ Request::segment(2) == 'profil' ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="info" width="20"></i>
                                <span>SMAN 7 Makassar</span>
                            </a>

                            <ul class="submenu {{ Request::segment(2) == 'profil' ? 'active' : '' }}">

                                <li>
                                    <a href="/{{ md5('user') }}/profil/data">Profil</a>
                                </li>

                                <li>
                                    <a href="/{{ md5('user') }}/profil/struktur">Struktur</a>
                                </li>

                            </ul>

                        </li> --}}

                        <li class="sidebar-item has-sub {{ Request::segment(2) == 'kegiatan' ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="calendar" width="20"></i>
                                <span>Kegiatan</span>
                            </a>

                            <ul class="submenu {{ Request::segment(2) == 'kegiatan' ? 'active' : '' }}">
                                <li>
                                    <a href="/{{ md5('user') }}/kegiatan/riwayat">Riwayat Kegiatan</a>
                                </li>

                                <li>
                                    <a href="/{{ md5('user') }}/kegiatan/jadwal">Jadwal Kegiatan</a>
                                </li>

                            </ul>

                        </li>

                        <li class="sidebar-item {{ Request::segment(2) == 'ekstrakurikuler' ? 'active' : '' }}">
                            <a href="{{ auth()->user()->ekstrakurikuler ? route('userIndex').'/ekstrakurikuler/pendaftar' : route('userIndex').'/ekstrakurikuler' }}" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>{{ auth()->user()->ekstrakurikuler ? 'Pendaftar' : 'Ekstrakurikuler' }}</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(2) == 'prestasi' ? 'active' : '' }}">
                            <a href="{{ route('userIndex').'/prestasi' }}" class='sidebar-link'>
                                <i data-feather="award" width="20"></i>
                                <span>Prestasi</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(2) == 'galeri' ? 'active' : '' }}">
                            <a href="{{ route('userIndex') }}/galeri" class='sidebar-link'>
                                <i data-feather="image" width="20"></i>
                                <span>Galeri</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a href="https://api.whatsapp.com/send?phone={{ '6285298654719' }}" target="_blank" class='sidebar-link'>
                                <i data-feather="message-circle" width="20"></i>
                                <span>Chat</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <h2 class="ms-auto"><marquee>Ekstrakurikuler SMAN 7 Makassar</marquee></h2>
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <i data-feather="user"></i>
                                <div class="d-none d-md-block d-lg-inline-block ms-3">{{ auth()->user()->nama }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/{{ md5('user') }}/akun"><i data-feather="user"></i> Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    @include('inc.scripts')
    @stack('scripts')
</body>
</html>
