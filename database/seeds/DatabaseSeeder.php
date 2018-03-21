<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('admin')->everything();
        Bouncer::allow('basic')->toOwn(App\Poem::class);
        Bouncer::allow('basic')->toOwn(App\Author::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(PoemsTableSeeder::class);
    }
}
