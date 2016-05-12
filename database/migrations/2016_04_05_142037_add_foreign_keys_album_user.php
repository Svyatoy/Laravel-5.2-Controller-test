<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysAlbumUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('album_user', function(Blueprint $table) {
            $table->index('album_id');
            $table->index('user_id');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::table('albums', function(Blueprint $table) {
            $table->index('user_id');
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
        Schema::table('album_user', function(Blueprint $table) {
            $table->dropIndex('album_user_user_id_index');
            $table->dropIndex('album_user_album_id_index');
            $table->dropForeign('album_user_user_id_foreign');
            $table->dropForeign('album_user_album_id_foreign');
        });
        Schema::table('albums', function(Blueprint $table) {
            $table->dropIndex('albums_user_id_index');
            $table->dropForeign('albums_user_id_foreign');
        });
    }
}
