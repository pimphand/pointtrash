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
        Schema::table('trash_category', function (Blueprint $table) {
            $table->boolean('status')->default(true)->index();
            $table->string('account_id')->nullable();
        });

        Schema::table('sub_trash_category', function (Blueprint $table) {
            $table->boolean('status')->default(true)->index();
            $table->string('account_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trash_category', function (Blueprint $table) {
            $table->dropColumn(['status', 'account_id']);
        });

        Schema::table('sub_trash_category', function (Blueprint $table) {
            $table->dropColumn(['status', 'account_id']);
        });
    }
};
