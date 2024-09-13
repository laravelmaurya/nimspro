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
        Schema::create('temporaries', function (Blueprint $table) {
            $table->id();
            $table->string('te')->nullable()->default(null);
            $table->string('c')->nullable()->default(null);
            $table->string('c2')->nullable()->default(null);
            $table->string('c3')->nullable()->default(null);
            $table->string('c4')->nullable()->default(null);
            $table->string('c5')->nullable()->default(null);
            $table->string('c6')->nullable()->default(null);
            $table->string('c7')->nullable()->default(null);
            $table->string('c8')->nullable()->default(null);
            $table->string('c9')->nullable()->default(null);
            $table->string('c10')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->string('title2')->nullable()->default(null);
            $table->string('title3')->nullable()->default(null);
            $table->string('title4')->nullable()->default(null);
            $table->string('title5')->nullable()->default(null);
            $table->string('title6')->nullable()->default(null);
            $table->string('title7')->nullable()->default(null);
            $table->string('title8')->nullable()->default(null);
            $table->string('title9')->nullable()->default(null);
            $table->string('title10')->nullable()->default(null);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporaries');
    }
};
