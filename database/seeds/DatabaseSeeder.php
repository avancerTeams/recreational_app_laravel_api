<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(App\Location::class, 20)->create();
        factory(App\User::class, 10)->create();
        factory(App\Category::class, 10)->create();
    }
}
