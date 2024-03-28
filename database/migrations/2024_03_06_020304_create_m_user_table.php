<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('useri', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('id_level')->index(); 
            $table->string('username', 20)->unique(); 
            $table->string('nama', 100);
            $table->string('password');
            $table->timestamps();

            $table->foreign('id_level')->references('id_level')->on('m_level');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('useri');
    }
};

