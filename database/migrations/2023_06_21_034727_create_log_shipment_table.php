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
        Schema::create('log_shipment', function (Blueprint $table) {
            $table->id();
            $table->integer('shipment_id');
            $table->integer('shiper_id');
            $table->integer('status');
            $table->integer('post_offices_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_shipment');
    }
};
