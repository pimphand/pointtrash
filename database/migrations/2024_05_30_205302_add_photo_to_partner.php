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
        Schema::table('partner', function (Blueprint $table) {
            $table->string('kk')->nullable()->after('status');
            $table->string('ktp')->nullable()->after('status');
            $table->string('sim')->nullable()->after('status');
            $table->string('kendaraan')->nullable()->after('status');
            $table->string('gudang')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partner', function (Blueprint $table) {
            $table->dropColumn('kk');
            $table->dropColumn('ktp');
            $table->dropColumn('sim');
            $table->dropColumn('kendaraan');
            $table->dropColumn('gudang');
        });
    }
};
