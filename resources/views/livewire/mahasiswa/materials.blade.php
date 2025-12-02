<div>
    <div class="dashboard-title mb-4">
        <h2 class="text-white">Materi Kuliah</h2>
    </div>

    <div class="dashboard-card p-3">
        @if($materials->count() === 0)
            <p class="text-white">Belum ada materi untuk ditampilkan.</p>
        @else
            <ul class="list-group">
                @foreach ($materials as $m)
                    <li class="list-group-item d-flex justify-content-between align-items-center">

                        @php
                            $ext = strtolower(pathinfo($m->file_url, PATHINFO_EXTENSION));
                            $canPreview = in_array($ext, ['pdf', 'jpg', 'jpeg', 'png', 'gif']);
                        @endphp

                        <div>
                            <strong>{{ $m->title }}</strong><br>
                            <small class="text-dark">{{ $m->course->name }}</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            {{-- LIKE --}}
                            <button
                                wire:click="toggleLike({{ $m->id }})"
                                class="material-icon-btn">
                                @if(isset($liked[$m->id]) && $liked[$m->id])
                                    <i data-lucide="heart" style="color:#d71c3e;"></i>
                                @else
                                    <i data-lucide="heart"></i>
                                @endif
                            </button>

                            {{-- PREVIEW --}}
                            @if($canPreview)
                                <a href="{{ Storage::url($m->file_url) }}"
                                target="_blank"
                                class="material-icon-btn">
                                    <i data-lucide="eye"></i>
                                </a>
                            @endif

                            <a href="{{ Storage::url($m->file_url) }}"
                            download
                            class="material-icon-btn">
                                <i data-lucide="download"></i>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
