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
        $dictionary = array('read', 'write');
        
        DB::table('album_user')->insert([
            'user_id' => random_int(103, 112),
            'album_id' => random_int(142, 201),
            'permission' => $dictionary[random_int(0,1)],
        ]);
    }
}
