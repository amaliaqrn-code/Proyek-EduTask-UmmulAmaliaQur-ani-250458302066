<div class="container mt-4 text-white">

    <h2>{{ $thread->title }}</h2>
    <small>Oleh {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}</small>

    <div class="mt-4">
        {!! nl2br(e($thread->content)) !!}
    </div>

    <a href="{{ route('mahasiswa.forum.index', $course->id) }}"
       class="btn btn-secondary mt-3">Kembali</a>

</div>
