document.addEventListener('DOMContentLoaded', () => {
    const makeSelect  = document.getElementById('make-select');
    const modelSelect = document.getElementById('model-select');
    if (!makeSelect || !modelSelect) return;

    const allModelOptions = Array.from(modelSelect.options).slice(1);

    function filterModels() {
        const makeId = makeSelect.value;
        while (modelSelect.options.length > 1) modelSelect.remove(1);
        const toShow = makeId
            ? allModelOptions.filter(o => o.dataset.make === makeId)
            : allModelOptions;
        toShow.forEach(o => modelSelect.add(o.cloneNode(true)));
    }

    makeSelect.addEventListener('change', () => {
        filterModels();
        modelSelect.value = '';
    });

    if (makeSelect.value) filterModels();
});


// ── Category accordion + search ──
document.addEventListener('DOMContentLoaded', () => {

    // Toggle accordion
    document.querySelectorAll('.cat-accordion').forEach(acc => {
        const trigger = acc.querySelector('.cat-accordion-trigger');
        if (!trigger) return;

        trigger.addEventListener('click', (e) => {
            if (e.target.closest('a')) return; // ссылка — не трогаем
            acc.classList.toggle('open');
        });

        // Стрелка
        const arrow = acc.querySelector('.cat-accordion-arrow');
        if (arrow) {
            arrow.addEventListener('click', (e) => {
                e.stopPropagation();
                acc.classList.toggle('open');
            });
        }
    });

    // Category search
    const input = document.getElementById('catSearch');
    if (!input) return;

    input.addEventListener('input', () => {
        const q = input.value.toLowerCase().trim();

        document.querySelectorAll('#catList .cat-accordion').forEach(acc => {
            const parentText = acc.querySelector('.cat-accordion-trigger a')?.textContent.toLowerCase() ?? '';
            const children   = Array.from(acc.querySelectorAll('.cat-accordion-body .cat-link'));
            const childMatch = children.some(c => c.textContent.toLowerCase().includes(q));
            const parentMatch = parentText.includes(q);

            if (q === '') {
                acc.style.display = '';
                children.forEach(c => c.style.display = '');
            } else if (parentMatch || childMatch) {
                acc.style.display = '';
                acc.classList.add('open');
                children.forEach(c => {
                    c.style.display = (c.textContent.toLowerCase().includes(q) || parentMatch) ? '' : 'none';
                });
            } else {
                acc.style.display = 'none';
            }
        });

        document.querySelectorAll('#catList > .cat-link').forEach(link => {
            if (link.textContent.toLowerCase().includes('все товары')) return;
            link.style.display = (q === '' || link.textContent.toLowerCase().includes(q)) ? '' : 'none';
        });
    });

});
