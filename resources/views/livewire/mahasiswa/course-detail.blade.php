<div class="dashboard-card p-4">
    <h2 class="text-white mb-3">
        {{ $course->name }} ({{ $course->code }})
    </h2>

    <p class="text-white">
        <strong>Dosen Pengampu:</strong>
        {{ $course->dosen->user->name ?? '-' }}
    </p>

    <p class="text-white mt-3">
        <strong>Deskripsi:</strong><br>
        {{ $course->description ?? 'Tidak ada deskripsi.' }}
    </p>

    <hr class="text-white">

    <h4 class="text-white">Materi</h4>
    @forelse($course->materials as $m)
        <p class="text-white">• {{ $m->title }}</p>
    @empty
        <p class="text-white">Tidak ada materi.</p>
    @endforelse

    <h4 class="text-white mt-4">Tugas</h4>
    @forelse($course->assignments as $a)
        <p class="text-white">• {{ $a->title }}</p>
    @empty
        <p class="text-white">Tidak ada tugas.</p>
    @endforelse

    <a href="{{ route('mahasiswa.mahasiswa.forum', $course->id) }}" class="btn btn-primary">
        Forum Diskusi
    </a>

</div>
