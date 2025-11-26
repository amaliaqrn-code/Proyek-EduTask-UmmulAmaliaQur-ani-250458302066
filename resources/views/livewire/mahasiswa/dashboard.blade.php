<div>
    <div class="dashboard-title">
        <h2>Dashboard Mahasiswa</h2>
    </div>

    <div class="row">

        {{-- Total Mata Kuliah --}}
        <div class="col-md-4 mb-4 text-white">
            <a href="{{ route('mahasiswa.courses.index') }}" style="text-decoration:none;">
                <div class="dashboard-card">
                    <h5>Total Mata Kuliah</h5>
                    <h3>{{ Auth::user()->mahasiswa->courses->count() }}</h3>
                </div>
            </a>
        </div>

        {{-- Tugas Belum Selesai --}}
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <h5>Tugas Belum Selesai</h5>
                <h3>{{ $tugasBelum }}</h3>
            </div>
        </div>

        {{-- Tugas Sudah Selesai --}}
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <h5>Tugas Sudah Selesai</h5>
                <h3>{{ $tugasSudah }}</h3>
            </div>
        </div>

        {{-- Point Activity --}}
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <h5>Activity Points</h5>
                <h3>{{ $totalPoints }}</h3>
            </div>
        </div>

        {{-- progres --}}
        <div class="col-md-12 mb-4">
            <div class="dashboard-card p-3">
                <h5>Progress Penyelesaian Tugas</h5>

                <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-success"
                        role="progressbar"
                        style="width: {{ $persentase }}%;"
                        aria-valuenow="{{ $persentase }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                        {{ $persentase }}%
                    </div>
                </div>
            </div>
        </div>

        {{-- deadline terdekat diambil 3 teratas --}}
        <div class="col-md-12 mb-4">
            <div class="dashboard-card p-3">
                <h5> Deadline Terdekat </h5>

                <ul class="list-group">
                    @foreach ($tugasTerdekat as $t)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>{{ $t->title }}</strong><br>
                                <small>Deadline: {{ $t->deadline }}</small>
                            </span>

                            {{-- Ambil status --}}
                            @php
                                $submission = \App\Models\Submission::where('assignment_id', $t->id)
                                    ->where('mahasiswa_id', Auth::user()->mahasiswa->id)
                                    ->first();
                                $status = $submission->status ?? 'not_submitted';
                            @endphp

                            @if ($status === 'submitted')
                                <span class="badge bg-success">Selesai</span>

                            @elseif ($status === 'late')
                                <span class="badge bg-warning text-dark">Terlambat</span>

                            @else
                                <span class="badge bg-danger">Belum</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
