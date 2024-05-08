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
        Schema::create('history_saldos', function (Blueprint $table) {
            $table->id();
            $table->string('account_id');
            $table->integer('saldo');
            $table->integer('saldo_before');
            $table->integer('saldo_after');
            $table->string('type');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_saldos');
    }
};
