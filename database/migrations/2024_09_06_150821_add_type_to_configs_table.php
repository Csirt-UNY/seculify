<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->enum('type', ['string', 'upload'])->default('string')->after('key');
        });
    }

    public function down(): void
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
