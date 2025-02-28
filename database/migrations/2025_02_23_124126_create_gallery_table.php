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
        Schema::create('gallery', function (Blueprint $table) {

                $table->id()->index();
                $table->foreignId('admin_id')->default(0)->index();
                $table->string('name');
                $table->string('title');
                $table->text('description');
                $table->text('abstract');
                $table->text('text');
                $table->string('keywords');
                $table->string('header_image');
                $table->string('thumbnail');
                $table->string('icon');
                $table->integer('order');
                $table->integer('visit')->default(0);
                $table->tinyInteger('status')->default(0);
                $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
