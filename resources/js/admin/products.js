document.addEventListener('DOMContentLoaded', () => {

    // ── Tab switching (edit page) ──
    function switchTab(name) {
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + name)?.classList.add('active');
        document.querySelector(`.tab-btn[data-tab="${name}"]`)?.classList.add('active');
        const url = new URL(window.location);
        name === 'info' ? url.searchParams.delete('tab') : url.searchParams.set('tab', name);
        history.replaceState(null, '', url);
    }

    document.querySelectorAll('.tab-btn[data-tab]').forEach(btn => {
        btn.addEventListener('click', () => switchTab(btn.dataset.tab));
    });

    // Restore tab from URL
    const tab = new URLSearchParams(window.location.search).get('tab');
    if (tab) switchTab(tab);

    // ── Image preview ──
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const box = document.getElementById('preview-box');
                if (box) box.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:contain;padding:1rem;">`;
            };
            reader.readAsDataURL(file);
        });
    }

});
