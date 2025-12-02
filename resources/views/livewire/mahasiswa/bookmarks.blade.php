<div class="container mt-4">

    <h3 class="mb-4">📌 Bookmark Saya</h3>

    @if($bookmarks->isEmpty())
        <div class="alert alert-info text-center">
            Anda belum memiliki bookmark apa pun.
        </div>
    @endif

    @foreach($bookmarks as $bm)
        <div class="card mb-3 shadow-sm">

            <div class="card-body d-flex justify-content-between align-items-start">

                {{-- KIRI: Info --}}
                <div class="grow">
                    {{-- Jenis --}}
                    <span class="badge bg-info mb-2">
                        {{ class_basename($bm->bookmarkable_type) }}
                    </span>

                    {{-- Judul / nama konten --}}
                    <div class="fw-bold fs-5">
                        @if($bm->bookmarkable_type === 'App\\Models\\Assignment')
                            <a href="{{ route('mahasiswa.assignments.show', $bm->bookmarkable->id) }}" class="text-decoration-none">
                                {{ $bm->bookmarkable->title }}
                            </a>
                        @endif

                        @if($bm->bookmarkable_type === 'App\\Models\\Material')
                            <a href="{{ route('mahasiswa.materials.show', $bm->bookmarkable->id) }}" class="text-decoration-none">
                                {{ $bm->bookmarkable->title }}
                            </a>
                        @endif

                        @if($bm->bookmarkable_type === 'App\\Models\\Course')
                            <a href="{{ route('mahasiswa.courses.show', $bm->bookmarkable->id) }}" class="text-decoration-none">
                                {{ $bm->bookmarkable->name }}
                            </a>
                        @endif
                    </div>

                    {{-- Tanggal --}}
                    <small class="text-muted">
                        Dibookmark: {{ $bm->created_at->diffForHumans() }}
                    </small>
                </div>

                {{-- KANAN: Tombol Unbookmark --}}
                <div>
                    <button class="btn btn-outline-primary btn-sm"
                            wire:click="toggleBookmark({{ $bm->bookmarkable_id }})"
                            title="Hapus Bookmark">

                        @if(isset($bookmarked[$bm->bookmarkable_id]) && $bookmarked[$bm->bookmarkable_id])
                            ★
                        @else
                            ☆
                        @endif

                    </button>
                </div>

            </div>

        </div>
    @endforeach

</div>
