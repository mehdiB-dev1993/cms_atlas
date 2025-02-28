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
        Schema::create('menus', function (Blueprint $table) {
            $table->id()->index();
            $table->foreignId('parent_id')->index();
            $table->string('title');
            $table->text('description');
            $table->text('abstract');
            $table->text('text');
            $table->string('keywords');
            $table->string('thumbnail');
            $table->string('icon');
            $table->string('header_image');
            $table->integer('order')->index();
            $table->integer('status')->default(0)->index();
            $table->integer('visit')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
