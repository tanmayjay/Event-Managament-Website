<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('usertype')->default("Client");
            $table->string('interest');
            $table->string('address');
            $table->string('gender');
            $table->date('dob');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->default("users/dp.jpg");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
