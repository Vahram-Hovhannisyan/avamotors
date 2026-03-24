<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_engines_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('engines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained()->onDelete('cascade');
            $table->string('name'); // например: "1.6 MPI", "2.0 TDI"
            $table->string('code')->nullable(); // код двигателя: "BSE", "BLS", "EA888"
            $table->decimal('displacement', 3, 1)->nullable(); // объем: 1.6, 2.0
            $table->integer('horsepower')->nullable(); // мощность в л.с.
            $table->integer('kw')->nullable(); // мощность в кВт
            $table->string('fuel_type')->nullable(); // бензин, дизель, гибрид, электро
            $table->integer('cylinders')->nullable(); // количество цилиндров
            $table->string('valves')->nullable(); // клапанов на цилиндр
            $table->string('fuel_system')->nullable(); // инжектор, карбюратор, common rail
            $table->string('turbo')->nullable(); // турбо, атмосферный
            $table->integer('year_from')->nullable();
            $table->integer('year_to')->nullable();
            $table->timestamps();

            $table->index(['car_model_id', 'code']);
            $table->index('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('engines');
    }
};
