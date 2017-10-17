<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;

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
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('gender', User::getGenders());
            $table->enum('nametitle', User::getNametitles());
            $table->string('state');
            $table->string('city');
            $table->string('postcode');
            $table->string('street');
            $table->date('dob');
            $table->string('phone');
            $table->string('cell');
            $table->string('picture');
            $table->string('nat', 2);
            $table->foreign('nat')->references('code')->on('countries');
            $table->string('email', 40)->unique();
            $table->string('username');
            $table->string('pass');
            $table->string('password');
            $table->string('passwordmd5');
            $table->string('passwordsha1');
            $table->string('passwordsha256');
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
