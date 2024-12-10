<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurant_typology', function (Blueprint $table) {
            $table->foreignId('restaurant_id')
                   ->constrained()
                   ->onUpdate('cascade')
                   ->onDelete('cascade');

            $table->foreignId('typology_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->timestamps();

            $table->primary([
                'restaurant_id',
                'typology_id'
                ]);

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_typology');
    }
};
