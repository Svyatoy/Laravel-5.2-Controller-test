<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use App\User;
use App\Album;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call(UsersTableSeeder::class);
        //factory(User::class, 10)->create();
        //factory(Album::class, 60)->create();
        //factory(Album::class, 60)->create();
        
        for ($i = 0; $i < 101; $i++) {
            $this->call(AlbumUserTableSeeder::class);
        }
        
        Model::reguard();
    }
}
