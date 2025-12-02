<div class="forum-container text-white">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('mahasiswa.forum.index', $course->id) }}"
           class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Kembali ke Forum
        </a>

        {{-- Delete Post Button (Only for Post Owner) --}}
        @if ($thread->user_id == auth()->id())
            <button wire:click="deleteThread"
                    wire:confirm="Yakin ingin menghapus postingan ini?"
                    class="btn btn-danger">
                <i class="bi bi-trash"></i> Hapus Postingan
            </button>
        @endif
    </div>

    {{-- Thread Detail --}}
    <div class="thread-detail-card">

        {{-- Thread Title --}}
        <h2>{{ $thread->title }}</h2>

        {{-- Thread Meta --}}
        <div class="thread-meta">
            <div class="thread-author">
                @php
                    $photo = 'https://ui-avatars.com/api/?name=' . urlencode($thread->user->name) . '&background=5A2EA6&color=fff';
                @endphp
                <img src="{{ $photo }}" alt="{{ $thread->user->name }}">
                <span>{{ $thread->user->name }}</span>
            </div>
            <span class="thread-divider">•</span>
            <span class="thread-time">{{ $thread->created_at->diffForHumans() }}</span>
        </div>

        {{-- Thread Content --}}
        <div class="thread-detail-content">
            {!! nl2br(e($thread->content)) !!}
        </div>

    </div>

    {{-- Reply Form --}}
    <div class="reply-section">
        <h4>
            <i class="bi bi-reply-fill"></i>
            Balas Diskusi
        </h4>

        <div class="reply-form">
            <form wire:submit.prevent="addReply">
                <div class="mb-3">
                    <textarea
                        class="form-control"
                        rows="5"
                        wire:model.defer="replyContent"
                        placeholder="Tulis balasan kamu di sini..."></textarea>
                    @error('replyContent')
                        <small class="text-danger d-block mt-2">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> Kirim Balasan
                </button>
            </form>
        </div>
    </div>

    {{-- Replies List --}}
    <div class="reply-section">
        <h4>
            <i class="bi bi-chat-dots"></i>
            Balasan ({{ $thread->replies->count() }})
        </h4>

        @forelse ($thread->replies as $r)
            <div class="reply-card">

                {{-- Reply Header --}}
                <div class="reply-card-header">
                    <div class="reply-author">
                        @php
                            $replyPhoto = 'https://ui-avatars.com/api/?name=' . urlencode($r->user->name) . '&background=6a42aa&color=fff';
                        @endphp
                        <img src="{{ $replyPhoto }}" alt="{{ $r->user->name }}">
                        <div>
                            <strong>{{ $r->user->name }}</strong>
                            <div class="reply-time">{{ $r->created_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    {{-- Delete Reply Button (Only for Reply Owner) --}}
                    @if ($r->user_id == auth()->id())
                        <button wire:click="deleteReply({{ $r->id }})"
                                wire:confirm="Yakin ingin menghapus balasan ini?"
                                class="btn-delete">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    @endif
                </div>

                {{-- Reply Content --}}
                <div class="reply-content">
                    {!! nl2br(e($r->content)) !!}
                </div>

            </div>
        @empty
            <div class="forum-empty">
                <i class="bi bi-chat"></i>
                <p>Belum ada balasan untuk postingan ini.<br>Jadilah yang pertama untuk membalas!</p>
            </div>
        @endforelse
    </div>

</div>
