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
        Schema::table('user', function (Blueprint $table) {
            $table->string('account_id')->nullable();
        });

        Schema::table('partner', function (Blueprint $table) {
            $table->string('account_id')->nullable();
        });

        Schema::table('account', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('branch')->nullable();
        });

        Schema::table('history_saldos', function (Blueprint $table) {
            $table->string('status')->default(0)->comment('0: Pending, 1: Success, 2: Failed');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });

        Schema::table('partner', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });

        Schema::table('history_saldos', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('account', function (Blueprint $table) {
            $table->dropColumn(['address', 'branch']);
        });
    }
};
