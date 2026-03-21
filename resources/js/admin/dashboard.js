document.addEventListener('DOMContentLoaded', () => {

    // ── Tab switching ──
    function switchTab(name) {
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + name)?.classList.add('active');
        document.querySelector(`.tab-btn[data-tab="${name}"]`)?.classList.add('active');
        const url = new URL(window.location);
        name === 'products' ? url.searchParams.delete('tab') : url.searchParams.set('tab', name);
        history.replaceState(null, '', url);
    }

    // Bind clicks
    document.querySelectorAll('.tab-btn[data-tab]').forEach(btn => {
        btn.addEventListener('click', () => switchTab(btn.dataset.tab));
    });

    // Restore tab from URL
    const tab = new URLSearchParams(window.location.search).get('tab');
    if (tab) switchTab(tab);

});
