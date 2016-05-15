<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255);
            $table->string('token', 255);
            $table->boolean('active');
            $table->timestamps();

            // Add indexes
            $table->index('email');
            $table->index('token');

            // Add foreign key
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resets', function(Blueprint $table) {
            // Drop foreign key
            $table->dropForeign('resets_email_foreign');

            // Drop indexes
            $table->dropIndex('resets_email_index');
            $table->dropIndex('resets_token_index');
        });

        // Drop table
        Schema::drop('resets');
    }
}
