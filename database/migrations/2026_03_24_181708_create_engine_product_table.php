<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_engine_product_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('engine_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('engine_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['engine_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('engine_product');
    }
};
