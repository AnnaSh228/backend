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
        Schema::create('rateds', function (Blueprint $table) {
            $table->id();
            $table->integer('mark');
            $table->text('comment')->nullable();
            $table->foreignId('lesson_id')->constrained();
            $table->foreignId('laboratory_work_id')->constrained()->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rateds');
    }
};
