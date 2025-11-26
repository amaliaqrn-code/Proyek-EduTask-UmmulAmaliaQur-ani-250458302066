<div class="container mt-4">

    <h3 class="mb-4">Daftar Bookmark Saya</h3>

    @if($bookmarks->isEmpty())
        <div class="alert alert-info">
            Anda belum memiliki bookmark apa pun
        </div>
    @endif

    @foreach($bookmarks as $bm)
        <div class="card mb-3 p-3 shadow-sm">

            <h5 class="fw-bold">
                {{ class_basename($bm->bookmarkable_type) }}
            </h5>

            <div>
                @if($bm->bookmarkable)
                    {{-- Assignment --}}
                    @if($bm->bookmarkable_type === 'App\\Models\\Assignment')
                        <a href="{{ route('mahasiswa.assignments.show', $bm->bookmarkable->id) }}"
                           class="text-decoration-none fw-semibold">
                            {{ $bm->bookmarkable->title }}
                        </a>
                    @endif

                    {{-- Materi --}}
                    @if($bm->bookmarkable_type === 'App\\Models\\Material')
                        <a href="{{ route('mahasiswa.materials.show', $bm->bookmarkable->id) }}"
                           class="text-decoration-none fw-semibold">
                            {{ $bm->bookmarkable->title }}
                        </a>
                    @endif

                    {{-- Course --}}
                    @if($bm->bookmarkable_type === 'App\\Models\\Course')
                        <a href="{{ route('mahasiswa.courses.show', $bm->bookmarkable->id) }}"
                           class="text-decoration-none fw-semibold">
                            {{ $bm->bookmarkable->name }}
                        </a>
                    @endif
                @endif
            </div>

            <small class="text-muted">
                Dibookmark pada: {{ $bm->created_at->diffForHumans() }}
            </small>
        </div>
    @endforeach

</div>
