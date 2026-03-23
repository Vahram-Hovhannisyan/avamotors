<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingTier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricingTierController extends Controller
{
    /**
     * Display a listing of pricing tiers.
     */
    public function index(Request $request)
    {
        $query = PricingTier::withCount('users');

        // Поиск по названию
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Фильтр по типу
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Фильтр по статусу
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $pricingTiers = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.pricing-tiers.index', compact('pricingTiers'));
    }

    /**
     * Show the form for creating a new pricing tier.
     */
    public function create()
    {
        $users = User::orderBy('name')->get(['id', 'name', 'email']);
        return view('admin.pricing-tiers.create', compact('users'));
    }

    /**
     * Store a newly created pricing tier.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pricing_tiers,name',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();
        try {
            // Создаем pricing tier
            $pricingTier = PricingTier::create([
                'name' => $validated['name'],
                'type' => $validated['type'],
                'value' => $validated['value'],
                'is_active' => $validated['is_active'] ?? true,
            ]);

            // Привязываем пользователей
            if (!empty($validated['user_ids'])) {
                $pricingTier->users()->attach($validated['user_ids']);
            }

            DB::commit();

            return redirect()
                ->route('admin.pricing-tiers.index')
                ->with('success', 'Уровень ценообразования успешно создан!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Ошибка при создании: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified pricing tier.
     */
    public function show(PricingTier $pricingTier)
    {
        $pricingTier->load(['users' => function($query) {
            $query->orderBy('name')->limit(20);
        }]);

        $usersCount = $pricingTier->users()->count();

        return view('admin.pricing-tiers.show', compact('pricingTier', 'usersCount'));
    }

    /**
     * Show the form for editing the specified pricing tier.
     */
    public function edit(PricingTier $pricingTier)
    {
        $users = User::orderBy('name')->get(['id', 'name', 'email']);
        $selectedUsers = $pricingTier->users()->pluck('user_id')->toArray();

        return view('admin.pricing-tiers.edit', compact('pricingTier', 'users', 'selectedUsers'));
    }

    /**
     * Update the specified pricing tier.
     */
    public function update(Request $request, PricingTier $pricingTier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pricing_tiers,name,' . $pricingTier->id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();
        try {
            // Обновляем pricing tier
            $pricingTier->update([
                'name' => $validated['name'],
                'type' => $validated['type'],
                'value' => $validated['value'],
                'is_active' => $validated['is_active'] ?? true,
            ]);

            // Синхронизируем пользователей
            $pricingTier->users()->sync($validated['user_ids'] ?? []);

            DB::commit();

            return redirect()
                ->route('admin.pricing-tiers.index')
                ->with('success', 'Уровень ценообразования успешно обновлен!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Ошибка при обновлении: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified pricing tier.
     */
    public function destroy(PricingTier $pricingTier)
    {
        try {
            $pricingTier->users()->detach(); // Удаляем связи
            $pricingTier->delete();

            return redirect()
                ->route('admin.pricing-tiers.index')
                ->with('success', 'Уровень ценообразования успешно удален!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Ошибка при удалении: ' . $e->getMessage());
        }
    }

    /**
     * Bulk assign users to pricing tier.
     */
    public function bulkAssign(Request $request, PricingTier $pricingTier)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        try {
            $pricingTier->users()->syncWithoutDetaching($request->user_ids);

            return redirect()
                ->route('admin.pricing-tiers.show', $pricingTier)
                ->with('success', 'Пользователи успешно добавлены!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Ошибка при добавлении пользователей: ' . $e->getMessage());
        }
    }

    /**
     * Remove users from pricing tier.
     */
    public function removeUsers(Request $request, PricingTier $pricingTier)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        try {
            $pricingTier->users()->detach($request->user_ids);

            return redirect()
                ->route('admin.pricing-tiers.show', $pricingTier)
                ->with('success', 'Пользователи успешно удалены!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Ошибка при удалении пользователей: ' . $e->getMessage());
        }
    }

    /**
     * Toggle pricing tier status.
     */
    public function toggleStatus(PricingTier $pricingTier)
    {
        $pricingTier->update(['is_active' => !$pricingTier->is_active]);

        $status = $pricingTier->is_active ? 'активирован' : 'деактивирован';

        return redirect()
            ->route('admin.pricing-tiers.index')
            ->with('success', "Уровень ценообразования успешно {$status}!");
    }
}
