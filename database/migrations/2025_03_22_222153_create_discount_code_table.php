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
        Schema::create('discount_code', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(null);
            $table->string('discount_code', 255)->default(null);
            $table->string('discount_price', 255)->default(null);
            $table->string('expiry_date')->default(null);
            $table->tinyInteger('type')->default(0)->comment('0: Percenteage, 1: Amount');
            $table->tinyInteger('usages')->default(1)->comment('1: Unlimited, 2: One Time');
            $table->timestamps();
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_code');
    }
};
