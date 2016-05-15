<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name', 255);
            $table->string('email');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Add index
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop index
        Schema::table('users', function(Blueprint $table) {
            $table->dropIndex('users_email_index');
        });

        // Drop table
        Schema::drop('users');
    }
}
