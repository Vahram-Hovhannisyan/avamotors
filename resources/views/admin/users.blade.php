@extends('layouts.layout')

@section('title', 'Пользователи — Админ')

@push('styles')
    @vite(['resources/css/admin/users.css'])
@endpush

@section('content')

    <div class="page-header">
        <h1 class="page-title">Пользователи</h1>
        <span class="page-meta">{{ now()->format('d.m.Y') }}</span>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if($errors->has('error'))
        <div class="flash-error">{{ $errors->first('error') }}</div>
    @endif

    <div class="quick-actions">
        <a href="{{ route('admin.dashboard') }}" class="quick-link">← Дашборд</a>
    </div>

    <form method="GET" class="toolbar">
        <div class="toolbar-search">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по имени или e-mail...">
            <button type="submit">Найти</button>
        </div>
        <select name="role" class="filter-select" onchange="this.form.submit()">
            <option value="">Все роли</option>
            <option value="admin"    {{ request('role') === 'admin'    ? 'selected' : '' }}>Администраторы</option>
            <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>Покупатели</option>
        </select>
        @if(request()->hasAny(['q', 'role']))
            <a href="{{ route('admin.users') }}" class="toolbar-reset">Сбросить</a>
        @endif
    </form>

    <div class="table-wrap">
        <div class="table-header">
            <span class="table-header-title">Все пользователи</span>
            <span class="table-total">{{ $users->total() }} пользователей</span>
        </div>
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th><th>Имя</th><th>E-mail</th><th>Телефон</th>
                <th>Роль</th><th>Дата регистрации</th><th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="td-id">{{ $user->id }}</td>
                    <td class="td-name">{{ $user->name }}</td>
                    <td class="td-muted">{{ $user->email }}</td>
                    <td class="td-muted">{{ $user->phone ?? '—' }}</td>
                    <td>
                        @if($user->isAdmin())
                            <span class="badge badge-blue">Администратор</span>
                        @else
                            <span class="badge badge-muted">Покупатель</span>
                        @endif
                    </td>
                    <td class="td-date">{{ $user->created_at->format('d.m.Y') }}</td>
                    <td class="td-nowrap">
                        <form method="POST" action="{{ route('admin.users.toggle-role', $user) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="action-link">
                                {{ $user->isAdmin() ? 'Сделать покупателем' : 'Сделать админом' }}
                            </button>
                        </form>
                        @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline"
                                  onsubmit="return confirm('Удалить пользователя «{{ $user->name }}»?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-link danger">Удалить</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="empty-cell">Пользователи не найдены</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">{{ $users->links() }}</div>

@endsection
