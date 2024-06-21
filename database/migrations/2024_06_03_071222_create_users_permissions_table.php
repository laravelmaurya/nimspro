<?php

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('users_permissions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_nims_wp_user_id');
        $table->unsignedBigInteger('permission_nims_wp_permission_id');




    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_permissions');
    }
};
