<div class="quick-actions">
    <a href="{{ route('admin.analogs') }}" class="quick-link">Все аналоги</a>
    <a href="{{ route('admin.products') }}" class="quick-link">Товары</a>
</div>

<div class="analogs-layout">

    <div class="analog-card">
        <div class="analog-card-header">
            <span class="analog-card-title">Создать аналог</span>
            <span class="analog-card-count">бренд + артикул</span>
        </div>
        <div class="analog-card-body">
            <form method="POST" action="{{ route('admin.analogs.store') }}">
                @csrf
                <input type="hidden" name="_redirect" value="dashboard">
                <div class="analog-form-group">
                    <label>Бренд *</label>
                    <input type="text" name="brand" value="{{ old('brand') }}"
                           placeholder="Bosch, Denso, Delphi, NGK..."
                           list="dash-brands-list" required autocomplete="off">
                    <datalist id="dash-brands-list">
                        @foreach($analogBrands as $b)<option value="{{ $b }}">@endforeach
                        <option value="Bosch"><option value="Denso"><option value="Delphi">
                        <option value="NGK"><option value="Champion"><option value="Valeo">
                        <option value="Bremi"><option value="Beru"><option value="Febi">
                    </datalist>
                </div>
                <div class="analog-form-group">
                    <label>Артикул *</label>
                    <input type="text" name="sku" value="{{ old('sku') }}"
                           placeholder="FR7DCX, W20EPR-U..." class="mono" required autocomplete="off">
                </div>
                <div class="analog-form-group">
                    <label>Примечание</label>
                    <input type="text" name="note" value="{{ old('note') }}" placeholder="Иридиевый, платиновый...">
                </div>
                <button type="submit" class="analog-add-btn analog-add-full">+ Создать аналог</button>
            </form>
            <div class="analog-hint">
                После создания — привяжи аналог к товару:<br>
                <a href="{{ route('admin.products') }}">Товары → Ред. → таб 🔄 Аналоги</a>
            </div>
        </div>
    </div>

    <div class="analog-card">
        <div class="analog-card-header">
            <span class="analog-card-title">Справочник аналогов</span>
            <span class="analog-card-count">{{ $totalAnalogs }} записей</span>
        </div>
        <div class="analog-search">
            <form method="GET" style="display:flex; gap:0.5rem; width:100%;">
                <input type="hidden" name="tab" value="analogs">
                <input type="text" name="aq" value="{{ request('aq') }}" placeholder="Бренд или артикул...">
                <button type="submit">Найти</button>
            </form>
        </div>
        <table class="analog-table">
            <thead>
            <tr><th>Бренд</th><th>Артикул</th><th>Примечание</th><th>Товаров</th><th></th></tr>
            </thead>
            <tbody>
            @forelse($analogList as $analog)
                <tr>
                    <td><span class="brand-pill">{{ $analog->brand }}</span></td>
                    <td class="analog-sku">{{ $analog->sku }}</td>
                    <td class="analog-note">{{ $analog->note ?? '—' }}</td>
                    <td class="analog-count">{{ $analog->products_count }}</td>
                    <td class="analog-actions">
                        <a href="{{ route('admin.analogs.edit', $analog) }}" class="action-link">Ред.</a>
                        <form method="POST" action="{{ route('admin.analogs.destroy', $analog) }}"
                              style="display:inline"
                              onsubmit="return confirm('Удалить аналог {{ $analog->brand }} {{ $analog->sku }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="analog-del-btn">✕</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-analog">
                        {{ request('aq') ? 'Ничего не найдено по «' . request('aq') . '»' : 'Справочник пуст — создайте первый аналог' }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if($analogList->hasPages())
            <div class="analog-pagination">
                {{ $analogList->appends(['tab' => 'analogs', 'aq' => request('aq')])->links() }}
            </div>
        @endif
    </div>

</div>
