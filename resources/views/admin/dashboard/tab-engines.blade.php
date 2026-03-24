{{-- resources/views/admin/dashboard/tab-engines.blade.php --}}

<div class="dashboard-section">
    <div class="section-header">
        <h3>🔧 Последние добавленные двигатели</h3>
        <a href="{{ route('admin.engines.index') }}" class="view-all">Все двигатели →</a>
    </div>

    @if(isset($fuelTypeStats) && $fuelTypeStats->count() > 0)
        <div class="fuel-stats" style="margin-bottom: 24px; padding: 16px; background: var(--surface2); border-radius: 12px;">
            <h4 style="margin-bottom: 12px; font-size: 14px;">📊 Статистика по типам топлива</h4>
            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                @foreach($fuelTypeStats as $stat)
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 24px;">
                            @switch($stat->fuel_type)
                                @case('Бензин') ⛽ @break
                                @case('Дизель') 🛢️ @break
                                @case('Гибрид') 🔋 @break
                                @case('Электро') ⚡ @break
                                @default 🔧
                            @endswitch
                        </span>
                        <div>
                            <div style="font-weight: 600;">{{ $stat->fuel_type }}</div>
                            <div style="font-size: 12px; color: var(--muted);">{{ $stat->count }} двигателей</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <table class="dashboard-table">
        <thead>
        <tr>
            <th>Марка</th>
            <th>Модель</th>
            <th>Двигатель</th>
            <th>Код</th>
            <th>Объем</th>
            <th>Мощность</th>
            <th>Топливо</th>
            <th>Годы</th>
        </tr>
        </thead>
        <tbody>
        @forelse($recentEngines ?? [] as $engine)
            <tr>
                <td>{{ $engine->carModel->carMake->name ?? '-' }}</td>
                <td>{{ $engine->carModel->name ?? '-' }}</td>
                <td><strong>{{ $engine->name }}</strong></td>
                <td><code>{{ $engine->code ?? '-' }}</code></td>
                <td>{{ $engine->displacement ? $engine->displacement . 'L' : '-' }}</td>
                <td>{{ $engine->horsepower ? $engine->horsepower . ' л.с.' : '-' }}</td>
                <td>
                    @switch($engine->fuel_type)
                        @case('Бензин') ⛽ @break
                        @case('Дизель') 🛢️ @break
                        @case('Гибрид') 🔋 @break
                        @case('Электро') ⚡ @break
                        @default {{ $engine->fuel_type ?? '-' }}
                    @endswitch
                </td>
                <td>
                    @if($engine->year_from || $engine->year_to)
                        {{ $engine->year_from ?? '?' }} - {{ $engine->year_to ?? '?' }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 40px;">
                    Двигатели не добавлены
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
