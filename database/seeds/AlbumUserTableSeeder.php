<?php

use Illuminate\Database\Seeder;

class AlbumUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('album_user')->insert([
            'user_id' => random_int(42, 51),
            'album_id' => random_int(5, 74),
        ]);
    }
}
