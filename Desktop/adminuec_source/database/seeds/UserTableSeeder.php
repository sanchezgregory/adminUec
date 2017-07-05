<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'active' => true,
            'role' => 'admin',
            'person_id' => 1
        ]);

        factory(User::class, 2)->create();
    }

}

