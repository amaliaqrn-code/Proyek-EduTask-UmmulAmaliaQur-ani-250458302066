<div class="dashboard-card p-4 text-white">
    <h3>{{ $assignment->title }}</h3>

    <p><strong>Deskripsi:</strong><br>{{ $assignment->description }}</p>
    <p><strong>Deadline:</strong> {{ $assignment->deadline }}</p>
    <hr>
    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <label>Upload File Tugas:</label>
            <input type="file" wire:model="file" class="form-control">
        </div>
            <button type="submit" class="btn-submit-task">Kumpulkan Tugas</button>
    </form>

    @if (session()->has('success'))
        <p class="text-success mt-2">{{ session('success') }}</p>
    @endif
</div>
