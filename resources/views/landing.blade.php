<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Digitaka - Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* Tipografi Premium */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap');

        :root {
            --primary: #1e3a8a;
            --primary-hover: #152c6b;
            --accent: #1e3a8a;
            --accent-hover: #152c6b;
            --bg-light: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-main);
            background-color: #ffffff;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* -------------------------------------
           1. NAVBAR LIGHT MODE
           ------------------------------------- */
        .navbar-custom {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            padding: 25px 0;
            background: transparent;
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand-custom .logo-text {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: var(--primary);
            letter-spacing: -1px;
            margin: 0;
        }

        .navbar-brand-custom .logo-text span {
            color: var(--accent);
        }

        .navbar-custom .nav-link {
            color: var(--text-main) !important;
            font-size: 15px;
            font-weight: 600;
            margin: 0 15px;
            transition: 0.3s;
        }

        .navbar-custom .nav-link:hover {
            color: var(--accent) !important;
        }

        /* -------------------------------------
           2. NEW HERO SECTION (SPLIT LAYOUT)
           ------------------------------------- */
        .hero-section {
            position: relative;
            background-color: var(--bg-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding-top: 80px;
            padding-bottom: 60px;
        }

        /* Ornamen Background (Glowing effect) */
        .hero-bg-shape-1 {
            position: absolute;
            top: -10%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: var(--accent);
            filter: blur(150px);
            opacity: 0.15;
            border-radius: 50%;
            z-index: 1;
        }
        .hero-bg-shape-2 {
            position: absolute;
            bottom: -10%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: var(--primary);
            filter: blur(150px);
            opacity: 0.1;
            border-radius: 50%;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            display: inline-block;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
            color: var(--accent);
            font-weight: 800;
            background: rgba(37, 99, 235, 0.1);
            padding: 6px 16px;
            border-radius: 50px;
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        .hero-title {
            font-size: clamp(2.5rem, 4.5vw, 4rem);
            margin-bottom: 20px;
            line-height: 1.15;
            letter-spacing: -1px;
            color: var(--text-main);
        }

        .hero-title span {
            color: var(--accent);
        }

        .hero-desc {
            font-size: 17px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 40px;
            line-height: 1.7;
        }

        /* Image Styling - Sentuhan "Kartun" Solid Shadow */
        .hero-img-wrapper {
            position: relative;
            z-index: 2;
            margin-top: 40px;
        }

        .hero-main-img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 24px;
            border: 3px solid #e2e8f0;
            box-shadow: -15px 15px 0 var(--primary);
            transition: transform 0.3s ease;
        }
        .hero-main-img:hover {
            transform: translate(5px, -5px);
            box-shadow: -20px 20px 0 var(--accent);
        }

        /* Floating Badge di atas gambar */
        .hero-floating-badge {
            position: absolute;
            bottom: 30px;
            left: -30px;
            background: white;
            padding: 15px 25px;
            border-radius: 16px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            border: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 15px;
            animation: floatIcon 4s infinite ease-in-out;
        }
        .hero-floating-badge i {
            font-size: 28px;
            color: var(--accent);
            background: #eff6ff;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }
        .hero-floating-badge div h6 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
        }
        .hero-floating-badge div p {
            margin: 0;
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* -------------------------------------
           BUTTONS
           ------------------------------------- */
        .btn-custom {
            padding: 14px 32px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-blue {
            background-color: var(--accent);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .btn-blue:hover {
            background-color: var(--accent-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }

        .btn-outline-custom {
            background-color: transparent;
            color: var(--text-main);
            border: 2px solid #cbd5e1;
        }
        .btn-outline-custom:hover {
            background-color: var(--bg-light);
            color: var(--accent);
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        /* -------------------------------------
           SISA CSS TETAP SAMA
           ------------------------------------- */
        .features-section { padding: 100px 0; background-color: white; text-align: center; }
        .features-section h3 { font-size: 26px; color: var(--text-main); max-width: 700px; margin: 0 auto 60px auto; line-height: 1.4; }
        .icon-box { padding: 20px; transition: 0.3s; border-radius: 16px; }
        .icon-box:hover { background-color: var(--bg-light); transform: translateY(-5px); }
        .icon-box i { display: inline-flex; align-items: center; justify-content: center; width: 70px; height: 70px; background-color: #eff6ff; color: var(--accent); font-size: 30px; border-radius: 20px; margin-bottom: 25px; transition: 0.3s; }
        .icon-box:hover i { background-color: var(--accent); color: white; }
        .icon-box h5 { font-size: 19px; color: var(--text-main); margin-bottom: 12px; }
        .icon-box p { font-size: 15px; color: var(--text-muted); line-height: 1.6; margin: 0; }

        .counter-section { background: linear-gradient(rgba(30, 58, 138, 0.95), rgba(30, 58, 138, 0.95)), url("{{ asset('image/perpus.jpg') }}") center center / cover fixed; padding: 60px 0; color: white; text-align: center; }
        .counter-content { display: flex; align-items: center; justify-content: center; gap: 20px; flex-wrap: wrap; }
        .counter-content h4 { font-size: 20px; margin: 0; letter-spacing: 0.5px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; }
        .digit-box-container { display: flex; gap: 5px; }
        .digit-box { background-color: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: white; font-size: 32px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; width: 50px; height: 65px; display: flex; align-items: center; justify-content: center; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }

        .services-section { background-color: var(--bg-light); padding: 100px 0; }
        .section-heading { text-align: center; margin-bottom: 60px; }
        .section-heading h2 { font-size: 32px; color: var(--text-main); margin-bottom: 15px; }
        .heading-line { width: 50px; height: 4px; background-color: var(--accent); margin: 0 auto 20px auto; border-radius: 2px; }
        .section-heading p { font-size: 16px; color: var(--text-muted); max-width: 600px; margin: 0 auto; }

        .service-card { background: white; display: flex; flex-direction: column; height: 100%; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); cursor: pointer; text-decoration: none; color: inherit; }
        .service-card:hover { box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.1); transform: translateY(-8px); border-color: var(--accent); }

        .vector-box { position: relative; height: 220px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-bottom: 1px solid #f1f5f9; transition: 0.4s ease; }
        .vector-bg-shape { position: absolute; background: rgba(255, 255, 255, 0.5); animation: shapePulse 4s infinite alternate ease-in-out; }
        .vector-bg-circle { width: 140px; height: 140px; border-radius: 50%; }
        .vector-bg-rect { width: 110px; height: 110px; border-radius: 24px; transform: rotate(45deg); animation: shapeSpin 15s linear infinite; }

        .vector-element { position: relative; z-index: 2; animation: floatIcon 3s infinite ease-in-out; transition: 0.4s ease; }
        .badge-float { position: absolute; bottom: -10px; right: -15px; background: white; border-radius: 50%; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 15px rgba(0,0,0,0.1); font-size: 20px; animation: bounceBadge 2.5s infinite ease-in-out; }

        .service-card:hover .vector-element { transform: scale(1.15); animation-play-state: paused; }
        .service-card:hover .vector-box { filter: brightness(1.05); }

        @keyframes shapePulse { 0% { transform: scale(1); opacity: 0.5; } 100% { transform: scale(1.2); opacity: 0.2; } }
        @keyframes shapeSpin { 100% { transform: rotate(405deg); } }
        @keyframes floatIcon { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        @keyframes bounceBadge { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

        .service-content { padding: 30px; flex-grow: 1; position: relative; }
        .service-content h5 { font-size: 20px; color: var(--text-main); margin-bottom: 12px; }
        .service-content p { font-size: 15px; color: var(--text-muted); line-height: 1.6; margin-bottom: 25px; }

        .arrow-btn { position: absolute; bottom: 25px; right: 25px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #eff6ff; color: var(--accent); border-radius: 50%; font-size: 18px; transition: 0.3s; }
        .service-card:hover .arrow-btn { background: var(--accent); color: white; transform: translateX(4px); }

        .news-section { background-color: white; padding: 100px 0; }
        .news-item { display: flex; align-items: center; gap: 40px; max-width: 850px; margin: 0 auto; text-align: left; padding: 20px; }
        .news-img { width: 180px; height: 180px; border-radius: 20px; object-fit: cover; flex-shrink: 0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .news-text h4 { font-size: 24px; color: var(--text-main); margin-bottom: 15px; line-height: 1.3; }
        .news-text p { font-size: 16px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px; }
        .news-date { display: inline-block; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; color: var(--accent); background: #eff6ff; padding: 5px 12px; border-radius: 20px; font-weight: 700; }
        .carousel-control-prev-icon, .carousel-control-next-icon { filter: invert(1) grayscale(100) brightness(0) opacity(0.2); width: 2.5rem; height: 2.5rem; }

        .footer { background-color: #0b1120; color: #94a3b8; padding: 80px 0 40px 0; font-size: 15px; }
        .footer .logo-img { width: 160px; margin-bottom: 20px; filter: brightness(0) invert(1); }
        .footer .text-muted { color: #94a3b8 !important; }
        .hover-text-white:hover { color: #ffffff !important; }
        .transition-all { transition: all 0.3s ease; }
        .social-icons { display: flex; gap: 12px; }
        .social-icons a { display: inline-flex; align-items: center; justify-content: center; width: 42px; height: 42px; background: rgba(255,255,255,0.05); border-radius: 10px; color: white; text-decoration: none; transition: all 0.3s ease; }
        .social-icons a:hover { background: var(--accent); color: white; transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3); }
        .footer-contact-box { display: flex; align-items: flex-start; gap: 15px; }
        .footer-contact-box i { color: #60a5fa; font-size: 28px; line-height: 1; }
        .footer-contact-box h5 { color: white; font-size: 20px; margin-bottom: 4px; letter-spacing: 0.5px; }
        .btn-footer { background-color: transparent; color: #e2e8f0; border: 1px solid rgba(255, 255, 255, 0.2); padding: 12px 28px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 700; border-radius: 8px; text-transform: uppercase; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-footer:hover { background-color: var(--accent); color: white; border-color: var(--accent); }
        .footer-bottom { margin-top: 60px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.08); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }

        @media (max-width: 992px) {
            .hero-img-wrapper { margin-top: 60px; }
            .hero-main-img { height: 400px; }
            .footer-col-contact { margin-top: 40px; }
        }

        @media (max-width: 768px) {
            .hero-section { text-align: center; padding-top: 100px; }
            .hero-title { font-size: 2.2rem; }
            .hero-desc { margin-left: auto; margin-right: auto; }
            .d-flex.gap-3.flex-wrap { justify-content: center; }
            .hero-floating-badge { left: 10%; bottom: -20px; }
            .news-item { flex-direction: column; text-align: center; }
            .news-img { width: 100%; height: 250px; }
            .footer-bottom { flex-direction: column; text-align: center; justify-content: center; }
        }
    </style>
</head>
<body>

    <header class="navbar-custom">
        <div class="container d-flex justify-content-between align-items-center">

            <a href="{{ url('/') }}" class="navbar-brand-custom">
                <img src="{{ asset('image/logo_dark2.jpg') }}" alt="Logo Icon" height="35" style="object-fit: contain;">
            </a>

            <nav class="d-none d-md-flex">
                <a href="#" class="nav-link">Beranda</a>
                <a href="#fitur" class="nav-link">Tentang Kami</a>
                <a href="#layanan" class="nav-link">Layanan</a>
            </nav>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('login') }}" class="nav-link p-0 text-dark"><i class="bi bi-box-arrow-in-right me-1"></i> Masuk</a>
                <a href="{{ route('register') }}" class="btn-custom btn-blue d-none d-lg-flex py-2 px-4 ms-3">Daftar</a>
            </div>
        </div>
    </header>

    <section class="hero-section">
        <div class="hero-bg-shape-1"></div>
        <div class="hero-bg-shape-2"></div>

        <div class="container hero-content">
            <div class="row align-items-center">

                <div class="col-lg-6 pe-lg-5">
                    <div class="hero-subtitle"><i class="bi bi-stars me-1"></i> Membangun Ekosistem Literasi Digital</div>
                    <h1 class="hero-title">Sistem Pengelolaan <span>Buku</span> Masa Depan</h1>
                    <p class="hero-desc">Pusat kelola inventaris, sirkulasi peminjaman, dan aktivitas literasi sekolah menengah dalam satu platform terintegrasi yang cerdas.</p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn-custom btn-blue">
                            GABUNG SEKARANG <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="#layanan" class="btn-custom btn-outline-custom">
                            PELAJARI LAYANAN
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-img-wrapper">
                        <img src="{{ asset('image/perpus.jpg') }}" alt="Perpustakaan" class="hero-main-img">

                        <div class="hero-floating-badge d-none d-sm-flex">
                            <i class="bi bi-check2-circle"></i>
                            <div>
                                <h6>Sistem Terintegrasi</h6>
                                <p>Tersinkronisasi Real-Time</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="fitur" class="features-section">
        <div class="container">
            <h3>Kami adalah ahli dalam tata kelola fasilitas literasi dan siap membantu ekosistem sekolah Anda.</h3>

            <div class="row g-4 mt-2">
                <div class="col-md-6 col-lg-3">
                    <div class="icon-box">
                        <i class="bi bi-book"></i>
                        <h5>Akses Mudah</h5>
                        <p>Mempercepat pencarian literatur dengan pemindaian digital yang responsif.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="icon-box">
                        <i class="bi bi-bar-chart-line"></i>
                        <h5>Optimalisasi Laporan</h5>
                        <p>Pantau pola peminjaman siswa dan kelola inventaris buku secara instan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="icon-box">
                        <i class="bi bi-shield-check"></i>
                        <h5>Keamanan Data</h5>
                        <p>Mengurangi risiko kehilangan buku lewat sistem tracking digital.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="icon-box">
                        <i class="bi bi-gear"></i>
                        <h5>Simplifikasi Proses</h5>
                        <p>Mengubah administrasi perpustakaan menjadi jauh lebih efisien.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="counter-section">
        <div class="container">
            <div class="counter-content">
                <h4>KAPASITAS SISTEM:</h4>
                <div class="digit-box-container">
                    <div class="digit-box">2</div>
                    <div class="digit-box">8</div>
                    <div class="digit-box">4</div>
                    <div class="digit-box">5</div>
                </div>
                <h4>EKSEMPLAR BUKU</h4>
            </div>
        </div>
    </section>

    <section id="layanan" class="services-section">
        <div class="container">
            <div class="section-heading">
                <h2>Layanan Terintegrasi</h2>
                <div class="heading-line"></div>
                <p>Digitaka menjadi partner terpercaya sekolah dalam membangun sistem manajemen literasi digital terintegrasi sejak tahun ini.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <a href="{{ route('register') }}" class="service-card">
                        <div class="vector-box" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);">
                            <div class="vector-bg-shape vector-bg-circle"></div>
                            <div class="vector-element">
                                <i class="bi bi-journal-check" style="font-size: 5.5rem; color: #1e3a8a;"></i>
                                <div class="badge-float" style="color: #2563eb;">
                                    <i class="bi bi-arrow-repeat"></i>
                                </div>
                            </div>
                        </div>
                        <div class="service-content">
                            <h5>Manajemen Peminjaman Digital</h5>
                            <p>Sistem inventarisasi dan rekapitulasi buku untuk mempermudah alur peminjaman. Proses pinjam-kembali menjadi cepat dan rapi.</p>
                            <div class="arrow-btn"><i class="bi bi-arrow-right"></i></div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('login') }}" class="service-card">
                        <div class="vector-box" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);">
                            <div class="vector-bg-shape vector-bg-rect"></div>
                            <div class="vector-element" style="animation-delay: 0.5s;">
                                <i class="bi bi-grid-1x2-fill" style="font-size: 5.5rem; color: #166534;"></i>
                                <div class="badge-float" style="color: #15803d; animation-delay: 0.5s;">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                        <div class="service-content">
                            <h5>Dashboard & Tracking Real-Time</h5>
                            <p>Kemudahan memantau kuantitas buku, performa baca siswa, dan sirkulasi koleksi perpustakaan dari satu panel khusus admin.</p>
                            <div class="arrow-btn"><i class="bi bi-arrow-right"></i></div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('register') }}" class="service-card">
                        <div class="vector-box" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);">
                            <div class="vector-bg-shape vector-bg-circle"></div>
                            <div class="vector-element" style="animation-delay: 1s;">
                                <i class="bi bi-phone-fill" style="font-size: 5.5rem; color: #b45309;"></i>
                                <div class="badge-float" style="color: #b45309; animation-delay: 1s;">
                                    <i class="bi bi-search"></i>
                                </div>
                            </div>
                        </div>
                        <div class="service-content">
                            <h5>Kemudahan Akses Siswa</h5>
                            <p>Setiap siswa dapat mengeksplorasi e-katalog kapan saja. Mencari buku berdasarkan kategori dengan interaktivitas yang adaptif.</p>
                            <div class="arrow-btn"><i class="bi bi-arrow-right"></i></div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="news-section">
        <div class="container">
            <div class="section-heading">
                <h2>Berita & Kegiatan</h2>
                <div class="heading-line"></div>
            </div>

            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="news-item">
                            <img src="{{ asset('image/perpus.jpg') }}" alt="News" class="news-img">
                            <div class="news-text">
                                <span class="news-date mb-2">10 Jun 2026</span>
                                <h4>Penerapan Digitaka Meningkatkan Minat Baca Siswa Secara Signifikan</h4>
                                <p>Sistem interaktif Digitaka membantu siswa menemukan literasi relevan, memotong birokrasi perpustakaan, serta mendorong pertumbuhan sirkulasi koleksi buku baru.</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="news-item">
                            <img src="{{ asset('image/perpus.jpg') }}" alt="News" class="news-img" style="filter: grayscale(0.5);">
                            <div class="news-text">
                                <span class="news-date mb-2">15 Jun 2026</span>
                                <h4>Program Perpustakaan Hijau, Modern, dan Cepat</h4>
                                <p>Perpustakaan tidak lagi memerlukan tumpukan kartu pinjam manual karena semua sudah tersinkronisasi lewat dashboard pintar terpusat.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 mb-5 mb-lg-0 pe-lg-5">
                    <img src="{{ asset('image/logoteks.png') }}" alt="Digitaka" class="logo-img">
                    <p class="mb-4" style="color: #cbd5e1; line-height: 1.7;">Membangun ekosistem literasi digital yang terintegrasi, aman, dan mudah digunakan. Memberikan solusi cerdas untuk manajemen perpustakaan sekolah.</p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-5 mb-md-0 footer-col-contact">
                    <h5 class="text-white mb-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">Pusat Bantuan</h5>
                    <div class="footer-contact-box mb-4">
                        <i class="bi bi-headset"></i>
                        <div>
                            <h5>0 (800) 700-93-28</h5>
                            <p class="mb-0 text-muted" style="font-size: 13px;">Layanan pengaduan keluhan<br>Senin - Jumat, 08:00 - 18:00 WIB</p>
                        </div>
                    </div>
                    <div class="footer-contact-box">
                        <i class="bi bi-envelope-at"></i>
                        <div>
                            <h5 style="font-size: 17px;">info@digitaka.id</h5>
                            <p class="mb-0 text-muted" style="font-size: 13px;">Kirim email untuk dukungan teknis</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-col-contact">
                    <h5 class="text-white mb-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">Akses Cepat</h5>
                    <ul class="list-unstyled mb-4 d-flex flex-column gap-2">
                        <li><a href="#" class="text-muted text-decoration-none hover-text-white transition-all"><i class="bi bi-chevron-right me-2" style="font-size: 12px;"></i> Beranda</a></li>
                        <li><a href="#fitur" class="text-muted text-decoration-none hover-text-white transition-all"><i class="bi bi-chevron-right me-2" style="font-size: 12px;"></i> Fitur Utama</a></li>
                        <li><a href="#layanan" class="text-muted text-decoration-none hover-text-white transition-all"><i class="bi bi-chevron-right me-2" style="font-size: 12px;"></i> Layanan Kami</a></li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-footer">
                        Gabung Sekarang <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

            <div class="footer-bottom">
                <div class="text-muted">
                    &copy; 2026 <strong>Digitaka</strong> Perpustakaan. Semua Hak Dilindungi.
                </div>
                <div class="d-flex gap-3 text-muted" style="font-size: 13px;">
                    <span>Kebijakan Privasi</span>
                    <span>•</span>
                    <span>Syarat & Ketentuan</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
