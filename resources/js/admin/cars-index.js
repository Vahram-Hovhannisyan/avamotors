(function () {
    const list   = document.getElementById('modelNamesList');
    const addBtn = document.getElementById('addRowBtn');
    if (!list || !addBtn) return;

    function makeRow() {
        const row = document.createElement('div');
        row.className = 'model-name-row';
        row.innerHTML = '<input type="text" name="names[]" class="f-input" placeholder="Модель..." required>'
            + '<button type="button" class="f-btn-ghost remove-row-btn" title="Удалить">✕</button>';
        row.querySelector('.remove-row-btn').addEventListener('click', () => {
            row.remove();
            syncRemoveBtns();
        });
        return row;
    }

    function syncRemoveBtns() {
        const rows = list.querySelectorAll('.model-name-row');
        rows.forEach(row => {
            row.querySelector('.remove-row-btn').style.display = rows.length > 1 ? '' : 'none';
        });
    }

    list.querySelector('.remove-row-btn').addEventListener('click', function () {
        this.closest('.model-name-row').remove();
        syncRemoveBtns();
    });

    addBtn.addEventListener('click', () => {
        const row = makeRow();
        list.appendChild(row);
        syncRemoveBtns();
        row.querySelector('input').focus();
    });
})();
