<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(fn($sq) =>
                $sq->where('name',  'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%")
            );
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function toggleRole(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Нельзя изменить роль своего аккаунта.']);
        }

        $user->update(['role' => $user->isAdmin() ? 'customer' : 'admin']);

        $newRole = $user->fresh()->isAdmin() ? 'Администратор' : 'Покупатель';

        return back()->with('success', "Роль «{$user->name}» изменена на «{$newRole}».");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Нельзя удалить собственный аккаунт.']);
        }

        $name = $user->name;
        $user->delete();

        return back()->with('success', "Пользователь «{$name}» удалён.");
    }
}
