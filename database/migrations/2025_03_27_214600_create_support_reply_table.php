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
        Schema::create('support_reply', function (Blueprint $table) {
            $table->id();
            $table->integer('support_id')->default(null);
            $table->integer('user_id')->default(null);
            $table->text('description')->default(null);
            $table->timestamps();
            $table->index('support_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_reply');
    }
};
