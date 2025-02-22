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
        Schema::table('state', function (Blueprint $table) {
            $table->index('countries_id'); // 인덱스 추가
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('state', function (Blueprint $table) {
            $table->dropIndex(['countries_id']); // 인덱스 제거
        });
    }
};
