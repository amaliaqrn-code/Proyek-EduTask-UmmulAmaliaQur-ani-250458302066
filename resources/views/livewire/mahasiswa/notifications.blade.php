<div>
<h3 class="mb-3">Notifikasi</h3>

<ul class="list-group">
    @forelse($notifications as $notif)
        <li class="list-group-item {{ !$notif->is_read ? 'fw-bold' : '' }}">
            {{ $notif->message }}
            <div class="small text-muted">{{ $notif->created_at->diffForHumans() }}</div>
        </li>
    @empty
        <li class="list-group-item">Tidak ada notifikasi.</li>
    @endforelse
</ul>
</div>
