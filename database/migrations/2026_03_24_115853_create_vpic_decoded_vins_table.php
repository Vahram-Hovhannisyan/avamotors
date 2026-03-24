<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vpic_decoded_vins', function (Blueprint $t) {
            $t->id();
            $t->string('vin', 17)->unique();
            $t->string('make')->nullable()->index();
            $t->string('model')->nullable()->index();
            $t->unsignedSmallInteger('model_year')->nullable()->index();
            $t->string('body_class')->nullable();
            $t->string('engine_cylinders')->nullable();
            $t->string('engine_model')->nullable();
            $t->string('plant_country')->nullable();
            $t->json('payload');
            $t->string('hash', 64)->index();
            $t->string('source', 16)->default('api');
            $t->timestamp('decoded_at')->nullable();

            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vpic_decoded_vins');
    }
};
