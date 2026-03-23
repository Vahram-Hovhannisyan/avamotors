import './bootstrap';

// ── User dropdown ──────────────────────────
document.addEventListener('click', function (e) {
    document.querySelectorAll('.user-menu-wrap.open').forEach(function (menu) {
        if (!menu.contains(e.target)) menu.classList.remove('open');
    });
});

// ── Mega menu ──────────────────────────────
const megaMenu    = document.getElementById('mega-menu');
const megaBtn     = document.getElementById('mega-btn');
const megaOverlay = document.getElementById('mega-overlay');

function openMega() {
    if (!megaMenu) return;
    megaMenu.classList.add('open');
    megaOverlay.classList.add('open');
    megaBtn.classList.add('mega-open');
    megaBtn.setAttribute('aria-expanded', 'true');
}

function closeMega() {
    if (!megaMenu) return;
    megaMenu.classList.remove('open');
    megaOverlay.classList.remove('open');
    megaBtn.classList.remove('mega-open');
    megaBtn.setAttribute('aria-expanded', 'false');
}

window.toggleMega = function () {
    megaMenu?.classList.contains('open') ? closeMega() : openMega();
};

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeMega();
});

// ── Admin: load page-specific scripts ──────
import './admin/dashboard.js';
import './admin/products.js';
import './admin/categories.js';
import './admin/cars-index.js';



