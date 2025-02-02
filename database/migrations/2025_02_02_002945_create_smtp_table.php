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
        Schema::create('smtp', function (Blueprint $table) {
            $table->id();
            $table->string('app_name', 255)->nullable();
            $table->string('mail_mailer', 255)->nullable();
            $table->string('mail_host', 255)->nullable();
            $table->string('mail_port', 255)->nullable();
            $table->string('mail_username', 255)->nullable();
            $table->string('mail_password', 255)->nullable();
            $table->string('mail_encryption', 255)->nullable();
            $table->string('mail_from_address', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smtp');
    }
};
