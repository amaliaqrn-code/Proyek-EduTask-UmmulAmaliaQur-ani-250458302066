<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('scss/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            lucide.createIcons();
        });
    </script>
    @livewireStyles
</head>
<body>

<div class="container-fluid mahasiswa-layout">
    <div class="row">
        {{-- Nav --}}
       @livewire('partials.navbar')

        {{-- SIDEBAR --}}
        <aside class="col-md-3 col-lg-2 mahasiswa-sidebar">

            <h6 class="sidebar-title px-3 mb-3">Menu</h6>

            <ul class="nav flex-column small px-2">

                <li class="nav-item mb-1">
                    @if(auth()->user()->role === 'mahasiswa')
                    <a class="sidebar-link" href="{{ route('mahasiswa.dashboard') }}">
                        <i class="bi bi-clipboard-check me-1"></i> Dashboard
                    </a>
                    @endif
                </li>

                <li class="nav-item mb-1">
                    <a class="sidebar-link" href="{{ route('mahasiswa.courses.index') }}">
                        <i class="bi bi-book me-1"></i> Mata Kuliah
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="sidebar-link" href="{{ route('mahasiswa.assignments.index') }}">
                        <i class="bi bi-list-check me-1"></i> Tugas Saya
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="sidebar-link" href="{{ route('mahasiswa.materials.index') }}">
                        <i class="bi bi-file-earmark-text me-1"></i> Materi
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="sidebar-link" href="{{ route('mahasiswa.courses.index') }}">
                        <i class="bi bi-chat-dots me-1"></i> Forum
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="sidebar-link" href="{{ route('mahasiswa.bookmarks.index') }}">
                        <i class="bi bi-bookmark-fill me-1"></i> Bookmark
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="sidebar-link" href="{{ route('mahasiswa.feedback.index') }}">
                        <i class="bi bi-people-fill me-1"></i> Feedback Dosen
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="sidebar-link" href="{{ route('mahasiswa.courses.pick') }}">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Mata Kuliah
                    </a>
                </li>
            </ul>
        </aside>

        {{-- CONTENT --}}
        <section class="col-md-9 col-lg-10 mahasiswa-content">
            {{ $slot }}
        </section>

    </div>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function refreshLucideIcons() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
    document.addEventListener("livewire:init", () => {

        Livewire.hook('message.processed', () => {
            refreshLucideIcons();
        });

        document.addEventListener("livewire:navigated", () => {
            refreshLucideIcons();
        });

        refreshLucideIcons();
    });
</script>
</body>
</html>
