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
        Schema::create('faq_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_id')
                ->constrained('faqs', 'id')
                ->onDelete('cascade');
            $table->foreignUuid('admin_id')
                ->constrained('users', 'uuid')
                ->onDelete('cascade');
            $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_responses');
    }
};
