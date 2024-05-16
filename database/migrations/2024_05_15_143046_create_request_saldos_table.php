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
        Schema::create('request_saldos', function (Blueprint $table) {
            $table->id();
            $table->string('account_id');
            $table->integer('saldo');
            $table->string('status')->comment('0: pending, 1: approved, 2: rejected');
            $table->string('type')->comment('widraw, tambah');
            $table->string('bukti')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_saldos');
    }
};
