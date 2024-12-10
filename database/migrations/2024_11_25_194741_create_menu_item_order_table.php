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
        Schema::create('menu_item_order', function (Blueprint $table) {
            $table->foreignId('menu_item_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('order_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('quantity')->nullable();        
            $table->timestamps();
            $table->primary([
                'menu_item_id',
                'order_id'
                ]);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_order');
    }
};
