<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResizedPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resized_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('photo_id')->unsigned();
            $table->string('size', 100);
            $table->string('src', 255);
            $table->enum('status', ['new', 'in_progress', 'completed', 'error'])->default('new');
            $table->string('comment', 255);
            $table->timestamps();

            // Add index
            $table->index('photo_id');

            // Add foreign key
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resized_photos', function(Blueprint $table) {
            // Drop foreign key
            $table->dropForeign('resized_photos_photo_id_foreign');

            // Drop index
            $table->dropIndex('resized_photos_photo_id_index');
        });

        // Drop table
        Schema::drop('resized_photos');    
    }
}
