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
            $table->foreignId('menu_id')->constrained('menus')->cascadeOnDelete();
            $table->string('url')->default('#');
            $table->string('target')->default('self');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('item_parent')->default(0);
            $table->smallInteger('level')->default(0)->comment('0: Main, 1: Child, 2: Grandchild');
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
