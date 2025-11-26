<div class="container mt-4">

    <h3 class="mb-4">Lengkapi Profil Mahasiswa</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="updateProfile" class="card p-4 bg-secondary text-white">

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" wire:model="nim" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" wire:model="major" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <input type="text" wire:model="class" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" wire:model="year" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>

    </form>
</div>
