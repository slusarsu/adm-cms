<?php

use App\Adm\Enums\AdmMailStatusEnum;
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
        Schema::create('adm_form_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adm_form_id')
                ->constrained(table: 'adm_forms', indexName: 'adm_form_id')
                ->onDelete('cascade');
            $table->json('payload')->nullable();
            $table->string('status')->default(AdmMailStatusEnum::NOT_SENT->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_form_items');
    }
};
