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
        //enum P -> pedente A -> aberto C -> concluido
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['P','A','C'])->default('P');
            $table->text('description');

            $table->unsignedBigInteger('user_id')->nullable(false); 
            $table->unsignedBigInteger('lesson_id')->nullable(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
