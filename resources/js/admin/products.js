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

    // ── Счётчик выбранных моделей (badge) ──
    function updateMakeCounter(group) {
        const checkboxes = group.querySelectorAll('input[type="checkbox"]');
        const total      = checkboxes.length;
        const checked    = Array.from(checkboxes).filter(cb => cb.checked).length;

        const counter = group.querySelector('.make-counter');
        if (counter) {
            counter.textContent = checked > 0 ? `${checked}/${total}` : total;
            counter.classList.toggle('has-checked', checked > 0);
        }

        const trigger = group.querySelector('.make-accordion-trigger');
        if (trigger) {
            const makeId = trigger.dataset.target?.replace('make-edit-', '').replace('make-', '');
            const badge  = document.getElementById('badge-edit-' + makeId)
                || document.getElementById('badge-' + makeId);
            if (badge) {
                badge.textContent = checked;
                badge.style.display = checked > 0 ? '' : 'none';
            }
            trigger.classList.toggle('has-selected', checked > 0);
        }
    }

    // ── Clear all selected models ──
    const clearBtn = document.getElementById('clearAllModels');
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            document.querySelectorAll('.make-group input[type="checkbox"]').forEach(cb => {
                cb.checked = false;
            });
            document.querySelectorAll('.make-group').forEach(group => {
                updateMakeCounter(group);
            });
        });
    }

    // ── Car makes accordion ──
    document.querySelectorAll('.make-accordion-trigger').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            if (e.target.closest('.make-select-all')) return;
            const group    = trigger.closest('.make-group');
            const targetId = trigger.dataset.target;
            const list     = document.getElementById(targetId);
            const isOpen   = group.classList.toggle('open');
            if (list) list.classList.toggle('open', isOpen);
        });
    });

    // Открываем группы где есть отмеченные чекбоксы
    document.querySelectorAll('.make-group').forEach(group => {
        if (group.querySelector('input[type="checkbox"]:checked')) {
            group.classList.add('open');
            const targetId = group.querySelector('.make-accordion-trigger')?.dataset.target;
            if (targetId) document.getElementById(targetId)?.classList.add('open');
        }
    });

    // ── Car search ──
    const carSearch = document.getElementById('carSearch');
    if (carSearch) {
        carSearch.addEventListener('input', () => {
            const q = carSearch.value.toLowerCase().trim();

            document.querySelectorAll('.make-group').forEach(group => {
                const makeName = group.querySelector('.make-accordion-name')?.textContent.toLowerCase() ?? '';
                const models   = Array.from(group.querySelectorAll('.model-check'));
                const targetId = group.querySelector('.make-accordion-trigger')?.dataset.target;
                const list     = targetId ? document.getElementById(targetId) : null;

                if (q === '') {
                    group.style.display = '';
                    models.forEach(m => m.style.display = '');
                    if (!group.querySelector('input:checked')) {
                        group.classList.remove('open');
                        list?.classList.remove('open');
                    }
                    return;
                }

                const matchingModels = models.filter(m => m.textContent.toLowerCase().includes(q));

                if (makeName.includes(q) || matchingModels.length > 0) {
                    group.style.display = '';
                    group.classList.add('open');
                    list?.classList.add('open');
                    models.forEach(m => {
                        m.style.display = (makeName.includes(q) || m.textContent.toLowerCase().includes(q)) ? '' : 'none';
                    });
                } else {
                    group.style.display = 'none';
                }
            });
        });
    }

    // ── Select all models for make ──
    document.querySelectorAll('.make-select-all').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const group     = btn.closest('.make-group');
            const boxes     = group.querySelectorAll('input[type="checkbox"]:not([style*="none"])');
            const allChecked = Array.from(boxes).every(b => b.checked);
            boxes.forEach(b => b.checked = !allChecked);
            updateMakeCounter(group);
        });
    });

    document.querySelectorAll('.make-group').forEach(group => {
        group.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.addEventListener('change', () => updateMakeCounter(group));
        });
        updateMakeCounter(group);
    });

});
