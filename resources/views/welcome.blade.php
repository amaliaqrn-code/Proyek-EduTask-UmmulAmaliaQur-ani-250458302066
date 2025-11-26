@extends('component.layouts.app')

@section('content')
    <section class="hero" id="beranda">
        <div class="container hero-section">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <div class="card">
                        <img src="https://i.pinimg.com/736x/ff/83/09/ff8309ccfe80047825602d4e1b34c4e3.jpg"
                             class="card-img-top" alt="Hero Image">
                    </div>
                </div>

                <div class="col-md-6">
                    <h2 class="hero-title">Ingin Kelola Tugas Kuliah Jadi Lebih Mudah?</h2>

                    <p class="hero-subtitle">
                        EduTask memudahkan mahasiswa dan dosen dalam pengumpulan tugas, pemberian nilai,
                        serta diskusi. Semuanya terintegrasi dalam satu platform kampus.
                    </p>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-hero">Login</a>
                    @endguest
                    @auth
                        @if(auth()->user()->role === 'mahasiswa')
                            <a class="btn btn-hero" href="{{ route('mahasiswa.dashboard') }}">
                                <i class="bi bi-clipboard-check me-1"></i> Dashboard
                            </a>
                        @endif
                    @endauth
                </div>

            </div>
        </div>
    </section>



    <!-- FITUR SECTION -->
    <section class="fitur" id="fitur">
        <div class="container">

            <h2 class="fitur-title">Fitur Unggulan</h2>
            <h6 class="fitur-subtitle">
                Alur lengkap untuk pengumpulan tugas: dari distribusi, diskusi, penilaian, hingga laporan.
            </h6>

            <div class="fitur-grid">

                <div class="fitur-card">
                    <div class="icon"><i class="bi bi-award-fill"></i></div>
                    <h3>Poin Aktivitas</h3>
                    <p>Dapat badge seperti “Rajin Kumpul Tepat Waktu”.</p>
                </div>

                <div class="fitur-card">
                    <div class="icon"><i class="bi bi-chat-dots-fill"></i></div>
                    <h3>Forum Diskusi</h3>
                    <p>Area tanya jawab tiap mata kuliah.</p>
                </div>

                <div class="fitur-card">
                    <div class="icon"><i class="bi bi-hand-thumbs-up-fill"></i></div>
                    <h3>Like</h3>
                    <p>Beri tanda suka pada postingan.</p>
                </div>

                <div class="fitur-card">
                    <div class="icon"><i class="bi bi-bookmark-fill"></i></div>
                    <h3>Bookmark</h3>
                    <p>Simpan materi & tugas untuk akses cepat.</p>
                </div>

            </div>

        </div>
    </section>
@endsection
