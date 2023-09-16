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
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short')->nullable();
            $table->text('content')->nullable();
            $table->string('thumb')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->bigInteger('views')->nullable();
            $table->string('locale')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_text_keys')->nullable();
            $table->string('seo_description')->nullable();
            $table->integer('order')->default(0);
            $table->foreignId('parent_id')
                ->nullable()
                ->references('id')
                ->on('shop_categories')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_categories');
    }
};
