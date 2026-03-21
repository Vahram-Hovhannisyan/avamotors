@extends('layouts.layout')

@section('title', 'Редактировать аналог — Админ')

@push('styles')
    @vite(['resources/css/admin/analogs.css'])
@endpush

@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ $analog->brand }} {{ $analog->sku }}</h1>
        <span class="page-meta">ID: {{ $analog->id }}</span>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="quick-actions">
        <a href="{{ route('admin.analogs') }}" class="quick-link">← Справочник аналогов</a>
    </div>

    <div class="edit-layout">

        <div class="form-card">
            <div class="form-card-title">Данные аналога</div>
            <form method="POST" action="{{ route('admin.analogs.update', $analog) }}">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Бренд *</label>
                    <input type="text" name="brand" value="{{ old('brand', $analog->brand) }}"
                           list="brands-list" required autocomplete="off">
                    <datalist id="brands-list">
                        @foreach($brands as $b)<option value="{{ $b }}">@endforeach
                    </datalist>
                    @error('brand') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Артикул *</label>
                    <input type="text" name="sku" value="{{ old('sku', $analog->sku) }}"
                           class="monospace" required autocomplete="off">
                    @error('sku') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Примечание</label>
                    <input type="text" name="note" value="{{ old('note', $analog->note) }}"
                           placeholder="Иридиевый, платиновый...">
                </div>

                <div class="form-actions">
                    <button type="submit" class="save-btn">Сохранить</button>
                    <a href="{{ route('admin.analogs') }}" class="form-cancel">Отмена</a>
                </div>
            </form>
        </div>

        <div class="linked-card">
            <div class="linked-header">
                <span class="linked-title">Привязан к товарам</span>
                <span class="linked-count">{{ $analog->products->count() }} шт.</span>
            </div>
            <table class="linked-table">
                <tbody>
                @forelse($analog->products as $product)
                    <tr>
                        <td>
                            <div class="product-name">{{ Str::limit($product->name, 32) }}</div>
                            <div class="product-sku">{{ $product->sku }}</div>
                        </td>
                        <td style="text-align:right; width:80px;">
                            <a href="{{ route('admin.products.edit', [$product, 'tab' => 'analogs']) }}" class="open-link">
                                Открыть →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td class="empty-linked">Не привязан ни к одному товару</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection
