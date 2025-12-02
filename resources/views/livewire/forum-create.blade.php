<div class="create-post-container text-white">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('mahasiswa.forum.index', $course->id) }}"
           class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Kembali ke Forum
        </a>
    </div>

    {{-- Create Post Form --}}
    <div class="create-post-card">

        <h2>
            <i class="bi bi-pencil-square"></i>
            Buat Postingan Baru
        </h2>
        <p class="text-muted mb-4">{{ $course->name }} - {{ $course->code }}</p>

        <form wire:submit.prevent="submit">

            {{-- Title Input --}}
            <div class="mb-4">
                <label class="form-label">
                    <i class="bi bi-card-heading"></i> Judul Postingan
                </label>
                <input
                    type="text"
                    wire:model="title"
                    class="form-control"
                    placeholder="Masukkan judul diskusi yang menarik...">
                @error('title')
                    <small class="text-danger d-block mt-2">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Content Textarea --}}
            <div class="mb-4">
                <label class="form-label">
                    <i class="bi bi-chat-left-text"></i> Isi Postingan
                </label>
                <textarea
                    wire:model="content"
                    class="form-control"
                    rows="8"
                    placeholder="Tulis pertanyaan, ide, atau topik diskusi kamu di sini..."></textarea>
                @error('content')
                    <small class="text-danger d-block mt-2">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> Posting
                </button>
                <a href="{{ route('mahasiswa.forum.index', $course->id) }}"
                   class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>

        </form>

    </div>

</div>
