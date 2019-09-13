<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
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

        if ( ! User::find(1) ) {
            $admin = User::create([
                'name' => 'Eleanor',
                'email' => 'eleanor@example.com',
                'password' => bcrypt(Str::random()),
            ]);

            Bouncer::sync($admin)->roles(['admin']);
        }
    }
}
