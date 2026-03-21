@extends('layouts.layout')

@section('title', 'Добавить аналог — Админ')

@push('styles')
    @vite(['resources/css/admin/analogs.css'])
@endpush

@section('content')

    <div class="page-header">
        <h1 class="page-title">Добавить аналог</h1>
    </div>

    <div class="quick-actions">
        <a href="{{ route('admin.analogs') }}" class="quick-link">← Справочник аналогов</a>
    </div>

    @if($errors->any())
        <div class="error-box">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <div class="form-card" style="max-width:480px;">
        <div class="form-card-title">Новый аналог</div>
        <form method="POST" action="{{ route('admin.analogs.store') }}">
            @csrf

            <div class="form-group">
                <label>Бренд *</label>
                <input type="text" name="brand" value="{{ old('brand') }}"
                       placeholder="Bosch, Denso, Delphi, Champion..."
                       list="brands-list" required autocomplete="off">
                <datalist id="brands-list">
                    @foreach($brands as $b)<option value="{{ $b }}">@endforeach
                    <option value="Bosch"><option value="Denso"><option value="Delphi">
                    <option value="NGK"><option value="Champion"><option value="Valeo">
                    <option value="Bremi"><option value="Beru"><option value="Febi">
                </datalist>
                @error('brand') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Артикул *</label>
                <input type="text" name="sku" value="{{ old('sku') }}"
                       placeholder="FR7DCX, W20EPR-U, HFS0001..."
                       class="monospace" required autocomplete="off">
                <div class="form-hint">Артикул производителя — уникальный для данного бренда</div>
                @error('sku') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Примечание</label>
                <input type="text" name="note" value="{{ old('note') }}"
                       placeholder="Иридиевый, платиновый, для дизеля...">
            </div>

            <div class="form-actions">
                <button type="submit" class="save-btn">Сохранить</button>
                <a href="{{ route('admin.analogs') }}" class="form-cancel">Отмена</a>
            </div>
        </form>
    </div>

@endsection
