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
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short')->nullable();
            $table->text('content')->nullable();
            $table->string('thumb')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->bigInteger('views')->nullable();
            $table->json('custom_fields')->nullable();
            $table->string('locale')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_text_keys')->nullable();
            $table->string('seo_description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('quantity')->nullable()->default(0);
            $table->string('sku')->nullable()->unique();
            $table->unsignedBigInteger('shop_category_id')->nullable();
            $table->unsignedBigInteger('shop_discount_id')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('shop_category_id')
                ->references('id')
                ->on('shop_categories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
};
