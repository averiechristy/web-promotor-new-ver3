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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akses_id');
            $table->unsignedBigInteger('role_id');
            $table->string('number');
            $table->string('kode_user')->nullable();
            $table->string('nama');
            $table->string('username');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->binary('avatar')->nullable();
            $table->string('phone_number');
            $table->timestamps();
            $table->softDeletes();      


          });

          
   Schema::table('users', function($table) {
    $table->foreign('akses_id')->references('id')->on('akses')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('role_id')->references('id')->on('user_roles')->onDelete('cascade')->onUpdate('cascade');
});

          
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
