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
        Schema::create('reply_support', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false); 
            $table->unsignedBigInteger('support_id')->nullable(false); 
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_support');
    }
};
