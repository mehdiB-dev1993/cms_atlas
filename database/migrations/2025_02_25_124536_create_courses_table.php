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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->index()->constrained('gallery')->onDelete('cascade');
            $table->string('title');
            $table->string('price');
            $table->string('duration');
            $table->string('teacher');
            $table->string('link');
            $table->text('text')->nullable();
            $table->text('full_text')->nullable();
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('source');
            $table->string('header_image');
            $table->string('thumbnail')->nullable();
            $table->string('icon')->nullable();
            $table->string('date')->index();
            $table->integer('order')->index();
            $table->integer('status')->default(1)->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
