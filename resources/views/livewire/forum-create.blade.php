<div class="container mt-4 text-white">

    <h2>Buat Postingan – {{ $course->name }}</h2>

    <form wire:submit.prevent="submit">

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" wire:model="title" class="form-control">
            @error('title') <small>{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Isi Postingan</label>
            <textarea wire:model="content" class="form-control" rows="6"></textarea>
            @error('content') <small>{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Posting</button>

    </form>
</div>
