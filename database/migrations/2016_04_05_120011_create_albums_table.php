<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('description');
            $table->boolean('public');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            
            // Add index
            $table->index('user_id');

            // Add relation to user as owner
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // First we need to drop relation
        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign('albums_user_id_foreign');
            $table->dropIndex('albums_user_id_index');
        });
        // Drop the  table
        Schema::drop('albums');
    }
}
