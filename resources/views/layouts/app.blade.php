<!-- Ini mendefinisikan tipe dokumen sebagai HTML5 -->
<!DOCTYPE html>
<!-- Elemen HTML root dengan atribut bahasa -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- Tautan ke CSS Bootstrap untuk styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<head>
    <!-- Tambahkan di layout utama -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Pengkodean karakter untuk dokumen -->
    <meta charset="utf-8">
    <!-- Pengaturan viewport responsif -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Judul aplikasi -->
    <title>Aplikasi Penitipan Barang</title>

    <!-- Fonts -->
    <!-- Tautan ke Google Fonts untuk gaya font kustom -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <!-- Tautan ke file CSS aplikasi -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
        <!-- Navigasi bar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Tombol back -->
                <a href="javascript:history.back()" class="mr-3 text-dark" style="font-size: 1.5rem;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <!-- Tautan merek untuk aplikasi -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="mr-2" style="height: 65px;">
                    <div class="d-flex flex-column">
                        <span class="font-weight-bold">{{ config('app.name', 'Laravel') }}</span>
                        <small class="text-muted">Aplikasi Penitipan Barang</small>
                    </div>
                </a>
                <!-- Tombol untuk mengubah tampilan navbar di perangkat mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Bagian navbar yang dapat dilipat -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Sisi Kiri Navbar -->
                    <!-- Placeholder untuk tautan navigasi sisi kiri -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Sisi Kanan Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Tautan Autentikasi -->
                        @guest
                            @if (Route::has('login'))
                                <!-- Tautan login untuk tamu -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <!-- Tautan registrasi untuk tamu -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Dropdown untuk pengguna yang sudah masuk -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <!-- Menu dropdown untuk tindakan pengguna -->
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Tautan logout -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <!-- Form tersembunyi untuk tindakan logout -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Area konten utama -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <!-- Tautan ke file JavaScript aplikasi -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
