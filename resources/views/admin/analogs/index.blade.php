@extends('layouts.layout')

@section('title', 'Аналоги — Админ')

@push('styles')
    @vite(['resources/css/admin/analogs.css'])
@endpush

@section('content')

    <div class="page-header">
        <h1 class="page-title">Справочник аналогов</h1>
        <span class="page-meta">{{ now()->format('d.m.Y') }}</span>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if($errors->has('error'))
        <div class="flash-error">{{ $errors->first('error') }}</div>
    @endif

    <div class="quick-actions">
        <a href="{{ route('admin.dashboard') }}"      class="quick-link">← Дашборд</a>
        <a href="{{ route('admin.analogs.create') }}" class="quick-link primary">+ Добавить аналог</a>
        <a href="{{ route('admin.products') }}"       class="quick-link">Товары</a>
    </div>

    <form method="GET" class="toolbar">
        <div class="toolbar-search">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по бренду или артикулу...">
            <button type="submit">Найти</button>
        </div>
        <select name="brand" class="filter-select" onchange="this.form.submit()">
            <option value="">Все бренды</option>
            @foreach($brands as $brand)
                <option value="{{ $brand }}" {{ request('brand') === $brand ? 'selected' : '' }}>{{ $brand }}</option>
            @endforeach
        </select>
        @if(request()->hasAny(['q', 'brand']))
            <a href="{{ route('admin.analogs') }}" class="toolbar-reset">Сбросить</a>
        @endif
    </form>

    <div class="table-wrap">
        <div class="table-header">
            <span class="table-header-title">Все аналоги</span>
            <span class="table-total">{{ $analogs->total() }} записей</span>
        </div>
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Бренд</th>
                <th>Артикул</th>
                <th>Примечание</th>
                <th>Товаров</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($analogs as $analog)
                <tr>
                    <td class="td-id">{{ $analog->id }}</td>
                    <td><span class="brand-pill">{{ $analog->brand }}</span></td>
                    <td class="td-sku">{{ $analog->sku }}</td>
                    <td class="td-muted">{{ $analog->note ?? '—' }}</td>
                    <td class="td-muted">{{ $analog->products_count }}</td>
                    <td class="td-nowrap">
                        <a href="{{ route('admin.analogs.edit', $analog) }}" class="action-link">Ред.</a>
                        <form method="POST" action="{{ route('admin.analogs.destroy', $analog) }}"
                              style="display:inline"
                              onsubmit="return confirm('Удалить аналог {{ $analog->brand }} {{ $analog->sku }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="del-btn">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="6">
                        Аналоги не найдены.
                        <a href="{{ route('admin.analogs.create') }}">Добавить первый →</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">{{ $analogs->links() }}</div>

@endsection
