<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlbumUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_user', function (Blueprint $table) {
            // Add fields
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('album_id')->unsigned();
            $table->enum('permission', ['read', 'write'])->default('read');
            $table->timestamps();
            
            // Add indexes
            $table->index('user_id');
            $table->index('album_id');
            
            // Add foreign keys
            $table->foreign('user_id')->references('id')->on('albums')->onDelete('cascade');
            $table->foreign('album_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('album_user', function(Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign('album_user_user_id_foreign');
            $table->dropForeign('album_user_album_id_foreign');
            
            // Drop indexes
            $table->dropIndex('album_user_user_id_index');
            $table->dropIndex('album_user_album_id_index');
        });
        
        // Drop table
        Schema::drop('album_user');
    }
}
