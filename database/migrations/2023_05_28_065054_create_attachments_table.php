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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable()->comment('value: image, audio, video, pdf, file etc.');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_mime')->nullable();
            $table->integer('file_size')->default(0)->comment('Size in kilobyte');
            $table->string('caption')->nullable();
            $table->string('alt_text')->nullable();
            $table->unsignedBigInteger('author_id')->default(0);

            $table->index(['file_name', 'id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
