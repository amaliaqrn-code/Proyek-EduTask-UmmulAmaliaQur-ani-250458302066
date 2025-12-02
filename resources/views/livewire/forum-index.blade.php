{{-- Forum Index - Halaman Daftar Postingan --}}
<div class="forum-container text-white">

    {{-- Header --}}
    <div class="forum-header">
        <h2>💬 Forum Diskusi</h2>
        <p>{{ $course->name }} - {{ $course->code }}</p>
    </div>

    {{-- Create Post Button --}}
    <div class="mb-4">
        <a href="{{ route('mahasiswa.forum.create', $course->id) }}"
           class="btn-create-post">
            <i class="bi bi-plus-circle"></i>
            Buat Postingan Baru
        </a>
    </div>

    {{-- Thread List - HANYA POSTINGAN, TANPA BALASAN --}}
    @forelse ($threads as $t)
        <div class="thread-card">

            {{-- Thread Title --}}
            <h5>{{ $t->title }}</h5>

            {{-- Thread Meta --}}
            <div class="thread-meta">
                <div class="thread-author">
                    @php
                        $photo = 'https://ui-avatars.com/api/?name=' . urlencode($t->user->name) . '&background=5A2EA6&color=fff';
                    @endphp
                    <img src="{{ $photo }}" alt="{{ $t->user->name }}">
                    <span>{{ $t->user->name }}</span>
                </div>
                <span class="thread-divider">•</span>
                <span class="thread-time">{{ $t->created_at->diffForHumans() }}</span>
                <span class="thread-divider">•</span>
                <span class="reply-count">
                    <i class="bi bi-chat-dots"></i> {{ $t->replies->count() }} Balasan
                </span>
            </div>

            {{-- Thread Content Preview --}}
            <p class="thread-content-preview">
                {{ Str::limit($t->content, 150) }}
            </p>

            {{-- Thread Actions --}}
            <div class="thread-actions">

                {{-- LIKE --}}
                <button wire:click="toggleLike({{ $t->id }})"
                        class="thread-action-btn {{ in_array($t->id, $liked) ? 'liked' : '' }}">
                    @if(in_array($t->id, $liked))
                        <i class="bi bi-heart-fill"></i>
                    @else
                        <i class="bi bi-heart"></i>
                    @endif
                    <span>{{ $t->likes->count() }}</span>
                </button>

                {{-- BOOKMARK --}}
                <button wire:click="toggleBookmark({{ $t->id }})"
                        class="thread-action-btn {{ in_array($t->id, $bookmarked) ? 'bookmarked' : '' }}">
                    @if(in_array($t->id, $bookmarked))
                        <i class="bi bi-bookmark-fill"></i> Tersimpan
                    @else
                        <i class="bi bi-bookmark"></i> Simpan
                    @endif
                </button>

                {{-- DETAIL - Klik untuk lihat balasan --}}
                <a href="{{ route('mahasiswa.forum.detail', [$course->id, $t->id]) }}"
                   class="thread-action-btn detail">
                    <i class="bi bi-arrow-right-circle"></i>
                    Lihat Detail & Balas
                </a>
            </div>
        </div>
    @empty
        <div class="forum-empty">
            <i class="bi bi-chat-left-text"></i>
            <p>Belum ada postingan di forum ini.<br>Jadilah yang pertama untuk memulai diskusi!</p>
        </div>
    @endforelse

</div>
