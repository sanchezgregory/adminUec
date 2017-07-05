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
        $this->call(CostsTableSeeder::class);
        $this->call(CursesTableSeeder::class);
        $this->call(ProffessionsTableSeeder::class);
        $this->call(PersonsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RepresentantsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
    }
}
