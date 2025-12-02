document.addEventListener("DOMContentLoaded", () => {
    if (typeof lucide !== "undefined") lucide.createIcons();
});

function refreshLucideIcons() {
    if (typeof lucide !== "undefined") lucide.createIcons();
}

document.addEventListener("livewire:init", () => {
    Livewire.hook('message.processed', () => refreshLucideIcons());
    document.addEventListener("livewire:navigated", () => refreshLucideIcons());
    refreshLucideIcons();
});

