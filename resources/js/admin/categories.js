// ── Index page: slug auto-generate from name ──
(function () {
    const nameInput = document.getElementById('cat-name');
    const slugInput = document.getElementById('cat-slug');
    if (!nameInput || !slugInput) return;

    let slugEdited = slugInput.value.length > 0;

    const map = {
        'а':'a','б':'b','в':'v','г':'g','д':'d','е':'e','ё':'yo','ж':'zh',
        'з':'z','и':'i','й':'y','к':'k','л':'l','м':'m','н':'n','о':'o',
        'п':'p','р':'r','с':'s','т':'t','у':'u','ф':'f','х':'kh','ц':'ts',
        'ч':'ch','ш':'sh','щ':'shch','ъ':'','ы':'y','ь':'','э':'e','ю':'yu','я':'ya'
    };

    function toSlug(str) {
        return str.toLowerCase()
            .split('').map(c => map[c] !== undefined ? map[c] : c).join('')
            .replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
    }

    nameInput.addEventListener('input', () => {
        if (!slugEdited) slugInput.value = toSlug(nameInput.value);
    });

    slugInput.addEventListener('input', () => {
        slugEdited = slugInput.value.length > 0;
    });
})();

// ── Edit page: slug preview ──
(function () {
    const slugInput   = document.getElementById('cat-slug');
    const slugPreview = document.getElementById('slug-preview');
    if (!slugInput || !slugPreview) return;

    slugInput.addEventListener('input', () => {
        slugPreview.textContent = slugInput.value || '...';
    });
})();
