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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id')->default(0)->index();
            $table->string('post_type')->default('post')->comment('Values: page, post');
            $table->string('post_name')->index();
            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('content_type')->default('basic')->comment('Values: basic, template, custom');
            $table->text('summary')->nullable();
            $table->smallInteger('status')->default(0)->comment('0: draft, 1: publish, 2: private, 3: trash');
            $table->boolean('comment_status')->default(0)->comment('0: disabled, 1: enabled');
            $table->integer('comment_count')->default(0);
            $table->string('guid')->nullable();
            $table->timestamp('posted_at')->nullable();
            $table->integer('post_parent')->default(0)->index();

            $table->index(['post_type', 'status', 'id'], 'type_status_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
