<div>
    <div class="dashboard-card mb-3 text-white text-center">
        <h3>Mata Kuliah</h3>
    </div>

    <div class="dashboard-card">
        <table class="table table-sm table-bordered table-striped text-white table-purple">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Dosen Pengampu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($availableCourses as $course)
                    <tr>
                        <td>{{ $course->code }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->dosen->user->name ?? '-' }}</td>
                        <td>
                            <button
                                class="btn btn-primary btn-sm"
                                wire:click="addCourse({{ $course->id }})">
                                + Tambah
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 text-center">
            {{ $availableCourses->links() }}
        </div>
    </div>
</div>
