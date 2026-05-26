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
            $table->increments('userid');
            $table->string('fullname',100);
            $table->string('username',30)-> unique();
            $table->string('email',50)-> unique();
            $table->string('password',50);
            $table->string('phone',20)-> nullable();
            $table->string('address',255)-> nullable();
            $table->tinyInteger('gender')-> default(0);
            $table->unsignedTinyInteger('role')-> default(1);
            $table->date('birthday')-> nullable();
            $table->tinyInteger('status')-> default(1);
            $table->timestamps();
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
