<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricing_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название tiers (например: "VIP", "Wholesale")
            $table->enum('type', ['percentage', 'fixed']); // процент или фиксированная сумма
            $table->decimal('value', 10, 2); // значение скидки/наценки
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Pivot таблица для связи pricing_tiers с пользователями
        Schema::create('pricing_tier_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_tier_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['pricing_tier_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing_tier_user');
        Schema::dropIfExists('pricing_tiers');
    }
};
