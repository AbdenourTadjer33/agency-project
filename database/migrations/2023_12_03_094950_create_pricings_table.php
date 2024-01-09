<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->morphs('pricingable');
            $table->float('price_adult')->nullable();
            $table->float('price_child')->nullable();
            $table->float('price_baby')->nullable();
            $table->float('price_lpd')->nullable();
            $table->float('price_ldp')->nullable();
            $table->float('price_lpc')->nullable();
            $table->float('price_single')->nullable();
            $table->float('price_double')->nullable();
            $table->float('price_triple')->nullable();
            $table->float('price_quadruple')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricings');
    }
};
