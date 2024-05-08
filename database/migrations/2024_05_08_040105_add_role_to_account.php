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
        Schema::table('account', function (Blueprint $table) {
            $table->string('roles')->default('cabang')->after('password');
            $table->boolean('is_active')->default(true)->after('roles');
            $table->integer('saldo')->default(0)->after('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account', function (Blueprint $table) {
            $table->dropColumn('roles');
            $table->dropColumn('is_active');
            $table->dropColumn('saldo');
        });
    }
};
