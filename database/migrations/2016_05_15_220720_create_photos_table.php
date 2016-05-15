<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('src', 255);
            $table->string('description', 255);
            $table->string('size', 100);
            $table->timestamps();

            // Add indexes
            $table->index('album_id');
            $table->index('user_id');

            // Add foreign keys
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos', function(Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign('photos_album_id_foreign');
            $table->dropForeign('photos_user_id_foreign');

            // Drop indexes
            $table->dropIndex('photos_album_id_index');
            $table->dropIndex('photos_user_id_index');
        });

        // Drop table
        Schema::drop('photos');
    }
}
