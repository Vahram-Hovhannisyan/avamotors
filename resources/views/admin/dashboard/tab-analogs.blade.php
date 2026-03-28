<div class="quick-actions">
    <a href="{{ route('admin.analogs') }}" class="quick-link">{{ __('admin.analogs.all_analogs') }}</a>
    <a href="{{ route('admin.products') }}" class="quick-link">{{ __('admin.analogs.products') }}</a>
</div>

<div class="analogs-layout">

    <div class="analog-card">
        <div class="analog-card-header">
            <span class="analog-card-title">{{ __('admin.analogs.create.title') }}</span>
            <span class="analog-card-count">{{ __('admin.analogs.create.subtitle') }}</span>
        </div>
        <div class="analog-card-body">
            <form method="POST" action="{{ route('admin.analogs.store') }}">
                @csrf
                <input type="hidden" name="_redirect" value="dashboard">
                <div class="analog-form-group">
                    <label>{{ __('admin.analogs.create.brand') }} *</label>
                    <input type="text" name="brand" value="{{ old('brand') }}"
                           placeholder="{{ __('admin.analogs.create.brand_placeholder') }}"
                           list="dash-brands-list" required autocomplete="off">
                    <datalist id="dash-brands-list">
                        @foreach($analogBrands as $b)<option value="{{ $b }}">@endforeach
                        <option value="Bosch"><option value="Denso"><option value="Delphi">
                        <option value="NGK"><option value="Champion"><option value="Valeo">
                        <option value="Bremi"><option value="Beru"><option value="Febi">
                    </datalist>
                </div>
                <div class="analog-form-group">
                    <label>{{ __('admin.analogs.create.sku') }} *</label>
                    <input type="text" name="sku" value="{{ old('sku') }}"
                           placeholder="{{ __('admin.analogs.create.sku_placeholder') }}" class="mono" required autocomplete="off">
                </div>
                <div class="analog-form-group">
                    <label>{{ __('admin.analogs.create.note') }}</label>
                    <input type="text" name="note" value="{{ old('note') }}" placeholder="{{ __('admin.analogs.create.note_placeholder') }}">
                </div>
                <button type="submit" class="analog-add-btn analog-add-full">+ {{ __('admin.analogs.create.button') }}</button>
            </form>
            <div class="analog-hint">
                {{ __('admin.analogs.create.hint') }}<br>
                <a href="{{ route('admin.products') }}">{{ __('admin.analogs.create.hint_link') }}</a>
            </div>
        </div>
    </div>

    <div class="analog-card">
        <div class="analog-card-header">
            <span class="analog-card-title">{{ __('admin.analogs.directory.title') }}</span>
            <span class="analog-card-count">{{ $totalAnalogs }} {{ __('admin.analogs.directory.records') }}</span>
        </div>
        <div class="analog-search">
            <form method="GET" style="display:flex; gap:0.5rem; width:100%;">
                <input type="hidden" name="tab" value="analogs">
                <input type="text" name="aq" value="{{ request('aq') }}" placeholder="{{ __('admin.analogs.directory.search_placeholder') }}">
                <button type="submit">{{ __('admin.analogs.directory.search_btn') }}</button>
            </form>
        </div>
        <table class="analog-table">
            <thead>
            <tr>
                <th>{{ __('admin.analogs.table.brand') }}</th>
                <th>{{ __('admin.analogs.table.sku') }}</th>
                <th>{{ __('admin.analogs.table.note') }}</th>
                <th>{{ __('admin.analogs.table.products_count') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($analogList as $analog)
                <tr>
                    <td><span class="brand-pill">{{ $analog->brand }}</span></td>
                    <td class="analog-sku">{{ $analog->sku }}</td>
                    <td class="analog-note">{{ $analog->note ?? '—' }}</td>
                    <td class="analog-count">{{ $analog->products_count }}</td>
                    <td class="analog-actions">
                        <a href="{{ route('admin.analogs.edit', $analog) }}" class="action-link">{{ __('admin.analogs.table.edit') }}</a>
                        <form method="POST" action="{{ route('admin.analogs.destroy', $analog) }}"
                              style="display:inline"
                              onsubmit="return confirm('{{ __('admin.analogs.table.delete_confirm', ['brand' => $analog->brand, 'sku' => $analog->sku]) }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="analog-del-btn">✕</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-analog">
                        @if(request('aq'))
                            {{ __('admin.analogs.directory.not_found', ['query' => request('aq')]) }}
                        @else
                            {{ __('admin.analogs.directory.empty') }}
                        @endif
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
