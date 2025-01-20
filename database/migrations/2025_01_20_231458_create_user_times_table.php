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
        Schema::create('user_times', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('week_id')->nullable();
            $table->string('start_time', 255)->nullable();
            $table->string('end_time', 255)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0:No Delete, 1: Yes Delete')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_times');
    }
};
