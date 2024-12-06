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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 64);
            $table->string('slug');
            $table->text('description');
            $table->decimal('price', 5, 2);
            $table->boolean('is_visible')
                    ->nullable()->default(false);
            $table->string('image', 2048)
                    ->nullable();
            $table->foreignId('restaurant_id')
                    ->nullable()
                    ->references('id')
                    ->on('restaurants')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
