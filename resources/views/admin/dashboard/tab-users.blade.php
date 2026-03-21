<div class="quick-actions">
    <a href="{{ route('admin.users') }}" class="quick-link">Все пользователи</a>
</div>
<div class="table-wrap">
    <div class="table-header">
        <span class="table-header-title">Последние пользователи</span>
        <a href="{{ route('admin.users') }}" class="table-header-link">Все →</a>
    </div>
    <table class="data-table">
        <thead><tr><th>Имя</th><th>E-mail</th><th>Телефон</th><th>Роль</th><th>Дата</th></tr></thead>
        <tbody>
        @forelse($recentUsers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td class="td-muted">{{ $user->email }}</td>
                <td class="td-muted">{{ $user->phone ?? '—' }}</td>
                <td>
                    @if($user->isAdmin())
                        <span class="badge badge-blue">Админ</span>
                    @else
                        <span class="badge badge-muted">Покупатель</span>
                    @endif
                </td>
                <td class="td-date">{{ $user->created_at->format('d.m.Y') }}</td>
            </tr>
        @empty
            <tr><td colspan="5" class="empty-cell">Пользователей пока нет</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
