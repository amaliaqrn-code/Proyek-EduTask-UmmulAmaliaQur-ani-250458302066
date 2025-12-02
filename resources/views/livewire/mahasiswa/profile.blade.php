<div class="container">

    <h3 class="mb-4">Lengkapi Profil Mahasiswa</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="updateProfile" class="card p-4 bg-secondary text-white">
        <div class="row">
        <div class="col-6 mb-3">
            <label class="form-label">NIM</label>
            <input type="text" wire:model="nim" class="form-control">
        </div>

        <div class="col-6 mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" wire:model="major" class="form-control">
        </div>

        <div class="col-6 mb-3">
            <label class="form-label">Kelas</label>
            <input type="text" wire:model="class" class="form-control">
        </div>

        <div class="col-6 mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" wire:model="year" class="form-control">
        </div>

        <div class="col-6 mb-3">
            <label>Foto Profil</label>
            <input type="file" wire:model="photo" class="form-control">

            {{-- Preview upload baru --}}
            @if($photo)
                <img src="{{ $photo->temporaryUrl() }}" width="120" class="mt-2">
            @endif

            {{-- Tampilkan foto lama --}}
            @if($oldPhoto)
                <p class="mt-2">Foto Saat Ini:</p>
                <img src="{{ asset('storage/' . $oldPhoto) }}" width="120">
            @endif
        </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>

    </form>
</div>
