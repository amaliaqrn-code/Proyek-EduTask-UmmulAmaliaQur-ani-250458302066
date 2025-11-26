<div class="container mt-4 text-white">

    <h2>Forum – {{ $course->name }}</h2>

    <a href="{{ route('mahasiswa.forum.create', $course->id) }}"
       class="btn btn-primary mb-3">Buat Postingan</a>

    @foreach ($threads as $t)
        <div class="card bg-dark text-white mb-3 p-3">

            <h5>{{ $t->title }}</h5>

            <p>
                {{ Str::limit($t->content, 120) }}
            </p>

            <small>Oleh: {{ $t->user->name }} • {{ $t->created_at->diffForHumans() }}</small>

            <div class="mt-2">
                <a href="{{ route('mahasiswa.forum.detail', [$course->id, $t->id]) }}"
                   class="btn btn-secondary btn-sm">Lihat Detail</a>
            </div>

        </div>
    @endforeach
</div>
