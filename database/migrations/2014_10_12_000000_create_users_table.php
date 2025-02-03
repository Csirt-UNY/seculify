<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('account_type', ['normal', 'google'])->default('normal');
            $table->string('password');
            $table->enum('role', ['user', 'admin', 'creator']);
            $table->string('agency')->nullable();
            $table->string('sub_unit')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
