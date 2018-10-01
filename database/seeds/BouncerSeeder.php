<?php

use Illuminate\Database\Seeder;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $admin = Bouncer::role()->firstOrCreate(
            [
                'name' => 'admin',
                'title' => 'Admin',
            ]
        );
        Bouncer::allow( $admin )->everything();
        // Basic
        $basic = Bouncer::role()->firstOrCreate(
            [
                'name' => 'basic',
                'title' => 'Basic',
            ]
        );
        Bouncer::allow( $basic )->toOwn( \App\User::class );
        Bouncer::allow( $basic )->toOwn( \App\Author::class );
        Bouncer::allow( $basic )->toOwn( \App\Poem::class );
    }
}
