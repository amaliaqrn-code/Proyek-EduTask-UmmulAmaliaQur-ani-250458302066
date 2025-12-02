<div class="container mt-4">

    <h3 class="mb-4">Feedback & Penilaian Dosen</h3>

    @if($feedbacks->isEmpty())
        <div class="alert alert-info">
            Anda belum memiliki feedback dari dosen.
        </div>
    @endif

    @foreach($feedbacks as $fb)
        <div class="card shadow-sm mb-3 p-3">

            <h5 class="fw-bold">
                @if($fb->assignment)
                    {{ $fb->assignment->title }}
                @else
                    Penilaian Dosen
                @endif
            </h5>

            <div class="mb-2 text-muted">
                @if($fb->assignment && $fb->assignment->course)
                    Mata Kuliah: {{ $fb->assignment->course->name }}
                @endif
            </div>

            <p class="mb-2">
                <strong>Feedback Dosen:</strong><br>
                {{ $fb->comment }}
            </p>

            <p class="mb-2">
                <strong>Nilai:</strong>
                @if($fb->score !== null)
                    <span class="badge bg-primary">{{ $fb->score }}</span>
                @else
                    <span class="text-muted">Belum ada nilai</span>
                @endif
            </p>

            @if($fb->dosen)
                <small class="text-muted">
                    Diberikan oleh: {{ $fb->dosen->user->name ?? 'Dosen' }} |
                    {{ $fb->created_at->diffForHumans() }}
                </small>
            @endif

        </div>
    @endforeach

</div>
