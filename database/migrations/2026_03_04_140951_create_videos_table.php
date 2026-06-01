<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('poster_path')->nullable();     // posters/xxx.jpg
            $table->string('stream_path');                 // videos/xxx.mp4
            $table->string('download_path')->nullable();   // downloads/xxx.mp4

            $table->unsignedInteger('duration_seconds')->nullable();

            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();

            $table->boolean('is_downloadable')->default(true);

            $table->timestamps();

            $table->index(['is_published', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};