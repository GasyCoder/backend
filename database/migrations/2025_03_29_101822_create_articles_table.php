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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->text('description')->nullable();
            $table->string('category');
            $table->json('tags')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamp('modified_at')->nullable();
            $table->date('published_at');
            $table->integer('read_time');
            $table->foreignId('author_id')->nullable()
            ->constrained('users')->nullOnDelete();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
