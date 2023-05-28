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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key_name')->unique()->index('setting_name');
            $table->mediumText('key_value')->nullable();
            // $table->string('data_type', 20)
            //     ->default('string')
            //     ->comment('Values: string,integer,float,numeric,text,rich-text,serialize,json');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
