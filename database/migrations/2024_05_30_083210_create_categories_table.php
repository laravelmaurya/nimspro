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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->unsigned()->default(1)->comment('1->active, 0->inactive');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable()->default(null);
            $table->string('image_name')->nullable()->default(null);
            $table->string('image_thumbnail')->nullable()->default(null);
            $table->string('image_path')->nullable()->default(null);
            $table->string('image_path_device')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
