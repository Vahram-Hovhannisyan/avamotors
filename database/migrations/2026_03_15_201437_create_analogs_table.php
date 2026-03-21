<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Справочник аналогов (бренд + артикул)
        Schema::create('analogs', function (Blueprint $table) {
            $table->id();
            $table->string('brand');          // Bosch, Denso, Delphi...
            $table->string('sku');            // FR7DCX, W20EPR-U...
            $table->string('note')->nullable(); // необязательное примечание
            $table->timestamps();

            $table->unique(['brand', 'sku']);
        });

        // Связь товар ↔ аналог (many-to-many)
        Schema::create('product_analog', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('analog_id')->constrained('analogs')->cascadeOnDelete();
            $table->primary(['product_id', 'analog_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_analog');
        Schema::dropIfExists('analogs');
    }
};
