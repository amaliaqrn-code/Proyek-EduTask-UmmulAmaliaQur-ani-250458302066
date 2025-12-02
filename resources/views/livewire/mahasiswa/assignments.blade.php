<div>
    <div class="dashboard-card-title mb-4 text-center">
        <h3 class="text-white mb-3">Tugas Saya</h3>
    </div>

    {{-- FILTER DI LUAR GRID --}}
    <div class="dashboard-card-title mb-4">
        <div class="mb-3">
            <label class="text-white fw-bold mb-1">Urutkan Deadline</label>
            <select wire:model="sortDeadline" class="form-select">
                <option value="asc">Terdekat ke Terjauh</option>
                <option value="desc">Terjauh ke Terdekat</option>
                <option value="today">Deadline Hari Ini</option>
                <option value="week">Deadline Minggu Ini</option>
                <option value="month">Deadline Bulan Ini</option>
            </select>
        </div>
    </div>

    {{-- GRID CARD --}}
    <div class="row">
        @foreach($assignments as $a)

            @php
                $submission = $submissions[$a->id] ?? null;
                $status = $submission->status ?? 'not_submitted';
            @endphp

            <div class="col-md-4 mb-3">
                <div class="dashboard-card p-3 h-100">

                    <div class="d-flex justify-content-between align-items-center">
                        <strong>{{ $a->course->name }}</strong>

                        <button wire:click="toggleBookmark({{ $a->id }})" class="btn-bookmark">
                            @if(isset($bookmarked[$a->id]) && $bookmarked[$a->id])
                                ★
                            @else
                                ☆
                            @endif
                        </button>
                    </div>

                    <h6>{{ $a->title }}</h6>
                    <p>{{ $a->deadline }}</p>

                    {{-- STATUS --}}
                    <div class="mb-2">
                        @if ($status == 'submitted')
                            <span class="badge bg-success">Sudah Dikumpulkan</span>
                        @elseif ($status == 'late')
                            <span class="badge bg-warning text-dark">Terlambat</span>
                        @else
                            <span class="badge bg-danger">Belum Dikerjakan</span>
                        @endif
                    </div>

                    <a href="{{ route('mahasiswa.assignments.show', $a->id) }}" class="btn btn-primary btn-sm">
                        Detail
                    </a>

                </div>
            </div>

        @endforeach
    </div>

</div>
