document.addEventListener('DOMContentLoaded', () => {

    // ── Custom select dropdowns ──
    function initCustomSelect(dropdownId, valueInputId, displayId, onSelect) {
        const dropdown = document.getElementById(dropdownId);
        if (!dropdown) return;

        const trigger   = dropdown.querySelector('.custom-select-trigger');
        const ddMenu    = dropdown.querySelector('.custom-select-dropdown');
        const search    = dropdown.querySelector('.custom-select-search');
        const options   = dropdown.querySelectorAll('.custom-select-option');
        const valueInput = document.getElementById(valueInputId);
        const display   = document.getElementById(displayId);

        // Toggle
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('.custom-select-dropdown.open').forEach(d => {
                if (d !== ddMenu) d.classList.remove('open');
            });
            ddMenu.classList.toggle('open');
            if (ddMenu.classList.contains('open')) {
                search.focus();
                search.value = '';
                filterOptions('');
            }
        });

        // Search
        search.addEventListener('input', () => filterOptions(search.value));

        function filterOptions(q) {
            const lq = q.toLowerCase().trim();
            options.forEach(opt => {
                const text = opt.textContent.toLowerCase();
                opt.style.display = (!lq || text.includes(lq)) ? '' : 'none';
            });
        }

        // Select option
        options.forEach(opt => {
            opt.addEventListener('click', () => {
                const val   = opt.dataset.value;
                const label = opt.dataset.label || opt.textContent.trim();
                valueInput.value  = val;
                display.textContent = label;
                options.forEach(o => o.classList.remove('active'));
                opt.classList.add('active');
                ddMenu.classList.remove('open');
                if (onSelect) onSelect(val);
            });
        });

        // Close on outside click
        document.addEventListener('click', () => ddMenu.classList.remove('open'));
    }

    // Make dropdown
    initCustomSelect('make-dropdown', 'make-value', 'make-display', (makeId) => {
        // Обновляем модели
        const modelOptions = document.querySelectorAll('#model-options .custom-select-option');
        modelOptions.forEach(opt => {
            if (!opt.dataset.value) return; // "Все модели"
            opt.style.display = (!makeId || opt.dataset.make === makeId) ? '' : 'none';
        });
        // Сбрасываем выбранную модель
        document.getElementById('model-value').value = '';
        document.getElementById('model-display').textContent = '— Все модели —';
        document.querySelectorAll('#model-options .custom-select-option').forEach(o => o.classList.remove('active'));
        document.querySelector('#model-options .custom-select-option[data-value=""]')?.classList.add('active');
    });

    // Model dropdown
    initCustomSelect('model-dropdown', 'model-value', 'model-display', null);

    // ── Category accordion ──
    document.querySelectorAll('.cat-accordion').forEach(acc => {
        const trigger = acc.querySelector('.cat-accordion-trigger');
        if (!trigger) return;

        trigger.addEventListener('click', (e) => {
            if (e.target.closest('a')) return;
            acc.classList.toggle('open');
        });

        const arrow = acc.querySelector('.cat-accordion-arrow');
        if (arrow) {
            arrow.addEventListener('click', (e) => {
                e.stopPropagation();
                acc.classList.toggle('open');
            });
        }
    });

    // ── Category search ──
    const catInput = document.getElementById('catSearch');
    if (catInput) {
        catInput.addEventListener('input', () => {
            const q = catInput.value.toLowerCase().trim();

            document.querySelectorAll('#catList .cat-accordion').forEach(acc => {
                const parentText  = acc.querySelector('.cat-accordion-trigger a')?.textContent.toLowerCase() ?? '';
                const children    = Array.from(acc.querySelectorAll('.cat-accordion-body .cat-link'));
                const childMatch  = children.some(c => c.textContent.toLowerCase().includes(q));
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
    }

});
