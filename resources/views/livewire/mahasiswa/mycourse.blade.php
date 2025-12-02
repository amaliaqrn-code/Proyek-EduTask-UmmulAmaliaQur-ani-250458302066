<div>
    <div class="dashboard-card-title mb-4 text-center text-shadow-black">
        <h3 class="text-white mb-3">Mata Kuliah Saya</h3>
    </div>

    <div class="dashboard-card-title mb-4">
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-4 mb-3">
                    <div class="dashboard-card p-3 h-100">
                        <strong>{{ $course->code }}</strong>
                        <p>{{ $course->name }}</p>

                        <a href="{{ route('mahasiswa.courses.show', $course->id) }}"
                           class="btn btn-primary btn-sm mt-2">
                            Lihat Detail
                        </a>
                        <a href="{{ route('mahasiswa.forum.index', $course->id) }}"
                            class="btn btn-primary btn-sm mt-2">
                            Buka Forum
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
