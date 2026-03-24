@extends('layouts.layout')

@section('title', 'Управление двигателями — AVAMotors')

@push('styles')
    @vite(['resources/css/engine.css'])
@endpush

@section('content')
    <div class="admin-header">
        <h1 class="admin-title">🔧 Управление двигателями</h1>
        <a href="{{ route('admin.engines.create') }}" class="btn-add">+ Добавить двигатель</a>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="filter-form">
        <select name="make" class="filter-select" onchange="this.form.submit()">
            <option value="">Все марки</option>
            @foreach($carMakes as $make)
                <option value="{{ $make->id }}" {{ request('make') == $make->id ? 'selected' : '' }}>
                    {{ $make->name }}
                </option>
            @endforeach
        </select>

        @if(request('make'))
            <select name="model" class="filter-select" onchange="this.form.submit()">
                <option value="">Все модели</option>
                @foreach($carMakes->find(request('make'))?->carModels ?? [] as $model)
                    <option value="{{ $model->id }}" {{ request('model') == $model->id ? 'selected' : '' }}>
                        {{ $model->name }}
                    </option>
                @endforeach
            </select>
        @endif
    </form>

    <table class="engines-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Марка</th>
            <th>Модель</th>
            <th>Двигатель</th>
            <th>Код</th>
            <th>Объем</th>
            <th>Мощность</th>
            <th>Топливо</th>
            <th>Годы</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($engines as $engine)
            <tr>
                <td>{{ $engine->id }}</td>
                <td>{{ $engine->carModel->carMake->name ?? '-' }}</td>
                <td>{{ $engine->carModel->name ?? '-' }}</td>
                <td><strong>{{ $engine->name }}</strong></td>
                <td><code>{{ $engine->code ?? '-' }}</code></td>
                <td>{{ $engine->displacement ? $engine->displacement . 'L' : '-' }}</td>
                <td>{{ $engine->horsepower ? $engine->horsepower . ' л.с.' : '-' }}</td>
                <td>{{ $engine->fuel_type ?? '-' }}</td>
                <td>
                    @if($engine->year_from || $engine->year_to)
                        {{ $engine->year_from ?? '?' }} - {{ $engine->year_to ?? '?' }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.engines.edit', $engine) }}" class="btn-edit">✎</a>
                    <form action="{{ route('admin.engines.destroy', $engine) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Удалить двигатель?')">✕</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" style="text-align: center; padding: 40px;">
                    Двигатели не найдены
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $engines->links() }}
    </div>
@endsection
