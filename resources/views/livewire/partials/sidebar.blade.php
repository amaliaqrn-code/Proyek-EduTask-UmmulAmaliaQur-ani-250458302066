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
