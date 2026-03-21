@extends('layouts.layout')

@section('title', 'Аналоги — ' . $product->name)

@push('styles')
    @vite(['resources/css/admin/products.css'])
@endpush

@section('content')

    <nav class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Дашборд</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('admin.products') }}">Товары</a>
        <span class="breadcrumb-sep">/</span>
        Аналоги
    </nav>

    <h1 class="page-title">Аналоги товара</h1>

    <div class="product-meta">
        <div>
            <div class="product-meta-name">{{ $product->name }}</div>
            <div class="product-meta-sku">Арт. {{ $product->sku }}</div>
        </div>
        <div class="product-meta-brand">{{ $product->brand ?? '—' }}</div>
        <div class="product-meta-cat">{{ $product->category->name }}</div>
        <a href="{{ route('admin.products.edit', $product) }}" class="product-meta-link">← Редактировать товар</a>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if($errors->has('error'))
        <div class="flash-error">{{ $errors->first('error') }}</div>
    @endif

    <div class="page-layout">

        {{-- Current analogs --}}
        <div class="section-card">
            <div class="section-card-header">
                <span class="section-card-title">Текущие аналоги</span>
                <span class="section-card-count">{{ $product->analogs->count() }} шт.</span>
            </div>
            <div class="section-card-body">
                <table class="data-table">
                    <thead><tr><th>Название</th><th>Бренд</th><th>Арт.</th><th></th></tr></thead>
                    <tbody>
                    @forelse($product->analogs as $analog)
                        <tr>
                            <td>
                                <a href="{{ route('product.show', $analog) }}" class="product-link" target="_blank">
                                    {{ Str::limit($analog->name, 40) }}
                                </a>
                            </td>
                            <td>
                                @if($analog->brand)
                                    <span class="brand-pill">{{ $analog->brand }}</span>
                                @else
                                    <span class="td-muted">—</span>
                                @endif
                            </td>
                            <td class="td-sku">{{ $analog->sku }}</td>
                            <td class="td-nowrap" style="text-align:right;">
                                <form method="POST" action="{{ route('admin.products.analogs.remove', [$product, $analog]) }}"
                                      onsubmit="return confirm('Удалить аналог?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="del-btn">✕ Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-cell">Аналоги не добавлены</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Add analogs --}}
        <div class="section-card">
            <div class="section-card-header">
                <span class="section-card-title">Добавить аналог</span>
                <span class="section-card-count">{{ $suggestions->total() }} доступно</span>
            </div>
            <form method="GET" class="search-bar">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию, SKU, бренду...">
                <button type="submit">Найти</button>
            </form>
            <div class="section-card-body">
                <table class="data-table">
                    <thead><tr><th>Название</th><th>Бренд</th><th></th></tr></thead>
                    <tbody>
                    @forelse($suggestions as $suggestion)
                        <tr>
                            <td>
                                <div class="suggest-name">{{ Str::limit($suggestion->name, 38) }}</div>
                                <div class="suggest-sku">{{ $suggestion->sku }}</div>
                            </td>
                            <td>
                                @if($suggestion->brand)
                                    <span class="brand-pill">{{ $suggestion->brand }}</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <form method="POST" action="{{ route('admin.products.analogs.add', $product) }}">
                                    @csrf
                                    <input type="hidden" name="analog_id" value="{{ $suggestion->id }}">
                                    <button type="submit" class="add-btn">+ Добавить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="empty-cell">
                                {{ request('q') ? 'Ничего не найдено по запросу «' . request('q') . '»' : 'Нет доступных товаров для добавления' }}
                            </td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($suggestions->hasPages())
                <div class="pagination-inner">{{ $suggestions->links() }}</div>
            @endif
        </div>

    </div>

@endsection
