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
            $table->foreignId('admin_id')->default(0)->index();
            $table->string('name');
            $table->string('title');
            $table->string('price');
            $table->string('discount');
            $table->string('duration');
            $table->string('teacher');
            $table->string('link');
            $table->string('start_date')->index();
            $table->text('description');
            $table->text('abstract');
            $table->text('text');
            $table->string('keywords');
            $table->string('source_link');
            $table->string('icon');
            $table->string('thumbnail');
            $table->string('header_image');
            $table->string('attached_file');
            $table->integer('order')->index();
            $table->integer('visit')->default(1);
            $table->integer('status')->default(1)->index();
            $table->string('published_at')->index();
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
